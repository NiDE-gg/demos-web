<?php
/**
 * Enhanced security functions for Demo system
 */

function siteURL()
{
    // Better HTTPS detection including proxy headers
    $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ||
               $_SERVER['SERVER_PORT'] == 443 ||
               (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ||
               (!empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] === 'on');

    $protocol = $isHttps ? "https://" : "http://";

    // Sanitize HTTP_HOST to prevent header injection
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $host = preg_replace('/[^a-zA-Z0-9.\-:]/', '', $host);

    return $protocol . $host . '/';
}
define('SITE_URL', siteURL());

function fileSizeConvert($bytes, $to, $decimal_places = 1)
{
    $bytes = (int) $bytes; // Ensure numeric input

    $formulas = array(
        'K' => number_format($bytes / 1024, $decimal_places),
        'M' => number_format($bytes / 1048576, $decimal_places),
        'G' => number_format($bytes / 1073741824, $decimal_places)
    );
    return isset($formulas[$to]) ? $formulas[$to] : '0';
}

/**
 * Set security headers
 */
function setSecurityHeaders()
{
    // Prevent XSS attacks
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: DENY');
    header('X-XSS-Protection: 1; mode=block');

    // Content Security Policy
    header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' https://code.jquery.com https://kit.fontawesome.com; style-src 'self' 'unsafe-inline' https://kit.fontawesome.com https://ka-f.fontawesome.com https://fonts.googleapis.com; img-src 'self' https://demos.nide.gg; font-src 'self' https://kit.fontawesome.com https://ka-f.fontawesome.com https://fonts.gstatic.com; connect-src 'self' https://ka-f.fontawesome.com;");

    // HSTS for HTTPS
    if (strpos(SITE_URL, 'https://') === 0) {
        header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
    }

    // Referrer policy
    header('Referrer-Policy: strict-origin-when-cross-origin');
}

// Apply security headers
setSecurityHeaders();
?>