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
- `style/` - frontend assets.

## Local development

From the `Demo/` directory:

```bash
php -S 127.0.0.1:8000 -t .
```

Then open `http://127.0.0.1:8000/`.

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

See also: `OPEN_SOURCE.md`.
