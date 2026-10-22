# Demo

Lightweight PHP frontend to browse and download CS:S demo files.

This project is linked to [srcdslab/autofastdl](https://github.com/srcdslab/autofastdl), which generates/synchronizes files on the FastDL side.

## Role in the architecture

- `autofastdl` populates demo directories (`css_ze/demos`, `css_zr/demos`).
- `Demo` provides the web interface to browse and download demos.
- Download links target `https://demos.nide.gg/...`.

## Features

- Lists demo archives for whitelisted servers (`css_ze`, `css_zr`).
- Parses filenames to display map, start date, and size.
- Validates/sanitizes user input through `DemoSecurity`.

## Structure

- `index.php` - entry point.
- `init.php` - include/constants bootstrap.
- `includes/security.php` - server/file validation, HTML escaping, security logging.
- `pages/server.php` - listing endpoint (`POST server`).
- `css_ze/demos`, `css_zr/demos` - demo directories.
- `style/` - frontend assets (static stylesheet, served directly by the web server).

## Local development

From the `Demo/` directory:

```bash
php -S 127.0.0.1:8000 -t .
```

Then open `http://127.0.0.1:8000/`.

## Tests & linting

```bash
composer install
composer test       # PHPUnit
composer lint        # PHP_CodeSniffer (PSR-12)
composer lint:fix    # auto-fix style issues
composer stan         # PHPStan static analysis (level 7)
```

CI (`.github/workflows/ci.yml`) runs a PHP syntax check, `phpcs`, PHPStan, and the PHPUnit suite on every push/PR. Minimum supported PHP version is 8.5.12 (fixes CVE-2026-109618 and CVE-2026-109619, see below).

## Running version in the footer

The footer displays the commit the site currently runs, linked to the matching commit on GitHub.
`getAppVersion()` (`includes/version.php`) resolves it from, in order:

1. the `APP_COMMIT` (or `GIT_COMMIT`) environment variable,
2. a `VERSION` file at the project root containing the commit hash,
3. the local `.git` directory (loose refs, packed refs, detached HEAD and worktrees).

If a deployment ships without `.git`, write the hash at deploy time, e.g.
`git rev-parse HEAD > VERSION`. When nothing resolves, the version line is simply omitted.

## Demo filename convention

Accepted formats:

- `auto-YYYYMMDD-HHMMSS-mapname.dem`
- `auto-YYYYMMDD-HHMMSS-mapname.dem.bz2`

## AutoFastDL configuration (reference)

On the `autofastdl` side, the main configuration is in `config.json` (see examples in the upstream repo):

- `config.example.fastdl.json`
- `config.example.demos.json`
- `config.example.torchlight.json`

Useful parameters for demos:

- `threads`, `debug`, `docker`
- `autoremove::*` (local/remote retention, autoclean, priority)
- `autoremove::after_upload` (remove local file after upload)

## Security

- Only whitelisted server keys are accepted.
- Filenames are validated before disk access.
- Security events are logged to `Demo/security.log`.
- Local secrets are ignored through `.gitignore` (`.env*`, `config.local.php`, `*secret*.php`, etc.).
- Request parameters that arrive as arrays are treated as empty, so no input can trigger a fatal error.

### PHP runtime (CVE-2026-109618 / CVE-2026-109619)

The server must run PHP 8.5.12 or later: older versions allow unauthenticated
remote code execution before any application code runs, so nothing in this
repository can mitigate it ([php.net advisory](https://www.php.net/archive/2026.php#2026-10-21-5)).
If the update has to wait, the advisory lists stopgaps for `php.ini` or the FPM
pool (not `.user.ini` / `ini_set()`), then restart every worker:

- `session.upload_progress.enabled = 0`
- `fatal_error_backtraces = 0`
- `post_max_size = 8M` (the site takes no uploads)
- `memory_limit = -1` via `php_admin_value`, with a container/cgroup memory limit

See also: `OPEN_SOURCE.md`.
