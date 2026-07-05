<?php
/**
 * Security functions for Demo system
 * Provides input validation and sanitization
 */

class DemoSecurity
{
    // Whitelist of allowed servers
    private static $allowedServers = [
        'css_ze' => [
            'name' => 'CS:S Zombie Escape',
            'path' => 'css_ze'
        ],
        'css_zr' => [
            'name' => 'CS:S Zombie Revival',
            'path' => 'css_zr'
        ]
    ];

    /**
     * Validate server parameter against whitelist
     */
    public static function validateServer($server)
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
     */
    public static function sanitizeFilename($filename)
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
    public static function escapeHtml($string)
    {
        return htmlspecialchars($string, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    /**
     * Get allowed servers list
     */
    public static function getAllowedServers()
    {
        return self::$allowedServers;
    }

    /**
     * Validate file path exists and is within allowed directory
     */
    public static function validateFilePath($server, $filename, $demoPath)
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
    public static function logSecurityEvent($event, $details = '')
    {
        $logEntry = date('Y-m-d H:i:s') . " - SECURITY: $event";
        if ($details) {
            $logEntry .= " - Details: $details";
        }
        $logEntry .= " - IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'unknown') . "\n";

        error_log($logEntry, 3, dirname(__DIR__) . '/security.log');
    }
}
?>
