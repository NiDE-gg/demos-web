<?php

/**
 * Security functions for Demo system
 * Provides input validation and sanitization
 */

class DemoSecurity
{
    /**
     * Whitelist of allowed servers.
     *
     * retention_days must match autoremove.remote.days in the server's
     * demos_css_<x> autofastdl config.json (on the game host): that container
     * deletes the uploaded demos, this value is only what the site displays.
     *
     * @var array<string, array{name: string, path: string, retention_days: int}>
     */
    private static $allowedServers = [
        'css_ze' => [
            'name' => 'CS:S Zombie Escape',
            'path' => 'css_ze',
            'retention_days' => 7
        ],
        'css_zr' => [
            'name' => 'CS:S Zombie Revival',
            'path' => 'css_zr',
            'retention_days' => 7
        ],
        'css_dust2' => [
            'name' => 'CS:S Dust2 24/7',
            'path' => 'css_dust2',
            'retention_days' => 4
        ],
        'css_dm' => [
            'name' => 'CS:S Dust2 Deathmatch',
            'path' => 'css_dm',
            'retention_days' => 4
        ],
        'css_gg' => [
            'name' => 'CS:S GunGame',
            'path' => 'css_gg',
            'retention_days' => 4
        ]
    ];

    /**
     * Read a request parameter as a string.
     * Arrays (e.g. ?server[]=x) become '' instead of reaching the typed
     * validators below, where they would raise an uncaught TypeError.
     */
    public static function stringParam(mixed $value): string
    {
        return is_string($value) ? $value : '';
    }

    /**
     * Validate server parameter against whitelist
     *
     * @return string|false
     */
    public static function validateServer(string $server)
    {
        if (empty($server)) {
            return false;
        }

        // Only allow alphanumeric and underscore
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $server)) {
            return false;
        }

        return isset(self::$allowedServers[$server]) ? $server : false;
    }

    /**
     * Sanitize filename to prevent path traversal and command injection
     *
     * @return string|false
     */
    public static function sanitizeFilename(string $filename)
    {
        if (empty($filename)) {
            return false;
        }

        // Remove any path traversal attempts
        $filename = basename($filename);

        // Only allow demo files with specific pattern
        // Support both .dem and .dem.bz2 formats
        // Pattern: auto-YYYYMMDD-HHMMSS-mapname.dem(.bz2)?
        // Map segment allows @ to support legacy recorder naming tokens.
        if (!preg_match('/^auto-\d{8}-\d{6}-[a-zA-Z0-9_\-\.@]+\.dem(\.bz2)?$/', $filename)) {
            return false;
        }

        return $filename;
    }

    /**
     * Escape HTML output to prevent XSS
     */
    public static function escapeHtml(string $string): string
    {
        return htmlspecialchars($string, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    /**
     * Get allowed servers list
     *
     * @return array<string, array{name: string, path: string, retention_days: int}>
     */
    public static function getAllowedServers(): array
    {
        return self::$allowedServers;
    }

    /**
     * "1 day" / "N days".
     */
    public static function daysLabel(int $days): string
    {
        return $days . ($days === 1 ? ' day' : ' days');
    }

    /**
     * Retention of every server at once: "7 days" when they all match,
     * "4 to 7 days" otherwise.
     */
    public static function retentionRangeLabel(): string
    {
        $days = array_column(self::$allowedServers, 'retention_days');
        if ($days === []) {
            return '';
        }

        $min = min($days);
        $max = max($days);

        return $min === $max ? self::daysLabel($min) : $min . ' to ' . self::daysLabel($max);
    }

    /**
     * Whether the servers keep their demos for different durations.
     */
    public static function retentionVaries(): bool
    {
        return count(array_unique(array_column(self::$allowedServers, 'retention_days'))) > 1;
    }

    /**
     * Validate file path exists and is within allowed directory
     *
     * @return string|false
     */
    public static function validateFilePath(string $server, string $filename, string $demoPath)
    {
        $validatedServer = self::validateServer($server);
        $validatedFilename = self::sanitizeFilename($filename);

        if (!$validatedServer || !$validatedFilename) {
            return false;
        }

        $fullPath = realpath($demoPath . '/' . $validatedServer . '/demos/' . $validatedFilename);
        $basePath = realpath($demoPath . '/' . $validatedServer . '/demos/');

        // Ensure file exists and is within the demos directory
        if (!$fullPath || !$basePath) {
            return false;
        }

        return strpos($fullPath, $basePath) === 0 ? $fullPath : false;
    }

    /**
     * Log security events
     */
    public static function logSecurityEvent(string $event, string $details = ''): void
    {
        $logEntry = date('Y-m-d H:i:s') . " - SECURITY: $event";
        if ($details) {
            $logEntry .= " - Details: $details";
        }
        $logEntry .= " - IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'unknown') . "\n";

        // data/ is denied to the web (data/.htaccess); the web root is not.
        $dataDir = dirname(__DIR__) . '/data';
        if (!is_dir($dataDir)) {
            mkdir($dataDir, 0770, true);
        }

        error_log($logEntry, 3, $dataDir . '/security.log');
    }
}
