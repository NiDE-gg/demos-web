<?php

/**
 * Resolve the commit the site is currently running, so the footer can display it.
 *
 * Lookup order (first match wins):
 *   1. APP_COMMIT / GIT_COMMIT environment variable (set by the deploy pipeline).
 *   2. A VERSION file at the project root (written by a deploy that ships no .git).
 *   3. The local .git directory (plain checkout, worktree or packed refs).
 */

/**
 * @return array{full: string, short: string}|null
 */
function getAppVersion(): ?array
{
    static $version = false;

    if ($version !== false) {
        /** @var array{full: string, short: string}|null $version */
        return $version;
    }

    $root = defined('ROOT') ? ROOT : dirname(__DIR__) . '/';
    $commit = resolveCommitFromEnvironment()
        ?? resolveCommitFromVersionFile($root . 'VERSION')
        ?? resolveCommitFromGit($root . '.git');

    $version = $commit === null ? null : [
        'full' => $commit,
        'short' => substr($commit, 0, 7),
    ];

    return $version;
}

function resolveCommitFromEnvironment(): ?string
{
    foreach (['APP_COMMIT', 'GIT_COMMIT'] as $name) {
        $value = getenv($name);
        if (is_string($value) && isCommitHash(trim($value))) {
            return strtolower(trim($value));
        }
    }

    return null;
}

function resolveCommitFromVersionFile(string $path): ?string
{
    if (!is_file($path) || !is_readable($path)) {
        return null;
    }

    $contents = trim((string) file_get_contents($path));

    return isCommitHash($contents) ? strtolower($contents) : null;
}

function resolveCommitFromGit(string $gitPath): ?string
{
    if (is_file($gitPath)) {
        // Worktree or submodule: ".git" is a file pointing at the real git dir.
        $contents = trim((string) file_get_contents($gitPath));
        if (!preg_match('/^gitdir:\s*(.+)$/m', $contents, $matches)) {
            return null;
        }

        $target = trim($matches[1]);
        $normalized = str_replace('\\', '/', $target);
        $isAbsolute = str_starts_with($normalized, '/')
            || (bool) preg_match('#^[a-zA-Z]:/#', $normalized);
        $gitPath = $isAbsolute ? $target : dirname($gitPath) . '/' . $target;
    }

    if (!is_dir($gitPath)) {
        return null;
    }

    $head = @file_get_contents($gitPath . '/HEAD');
    if ($head === false) {
        return null;
    }

    $head = trim($head);

    // Detached HEAD: the hash is stored directly.
    if (isCommitHash($head)) {
        return strtolower($head);
    }

    if (!preg_match('/^ref:\s*(\S+)$/', $head, $matches)) {
        return null;
    }

    $ref = $matches[1];
    $refFile = $gitPath . '/' . $ref;

    if (is_file($refFile)) {
        $hash = trim((string) file_get_contents($refFile));
        if (isCommitHash($hash)) {
            return strtolower($hash);
        }
    }

    return resolveCommitFromPackedRefs($gitPath . '/packed-refs', $ref);
}

function resolveCommitFromPackedRefs(string $packedRefsPath, string $ref): ?string
{
    if (!is_file($packedRefsPath)) {
        return null;
    }

    $lines = file($packedRefsPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($lines === false) {
        return null;
    }

    foreach ($lines as $line) {
        if ($line === '' || $line[0] === '#' || $line[0] === '^') {
            continue;
        }

        $parts = preg_split('/\s+/', trim($line), 2);
        if ($parts === false || count($parts) !== 2) {
            continue;
        }

        [$hash, $name] = $parts;
        if ($name === $ref && isCommitHash($hash)) {
            return strtolower($hash);
        }
    }

    return null;
}

function isCommitHash(string $value): bool
{
    return (bool) preg_match('/^[0-9a-fA-F]{7,40}$/', $value);
}
