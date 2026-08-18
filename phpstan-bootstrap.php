<?php

// func.php reads $_SERVER at include time (siteURL(), setSecurityHeaders());
// fill in the keys it expects so static analysis doesn't warn about a CLI
// context missing them.
$_SERVER += [
    'SERVER_PORT' => 80,
    'HTTP_HOST' => 'localhost',
];

require_once __DIR__ . '/includes/func.php';
