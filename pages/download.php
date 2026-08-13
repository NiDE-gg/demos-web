<?php
include_once('../includes/func.php');
include_once('../includes/security.php');
include_once('../includes/downloads.php');

$server = $_GET['server'] ?? '';
$file = $_GET['file'] ?? '';

$validatedServer = DemoSecurity::validateServer($server);
$validatedFilename = DemoSecurity::sanitizeFilename($file);

if (!$validatedServer || !$validatedFilename) {
    DemoSecurity::logSecurityEvent('Invalid download parameters', "server=$server file=$file");
    http_response_code(400);
    echo 'Invalid request';
    exit;
}

$demoRoot = realpath(dirname(__DIR__) . '/' . $validatedServer . '/demos/');
if (!$demoRoot || !is_file($demoRoot . '/' . $validatedFilename)) {
    http_response_code(404);
    echo 'Demo not found';
    exit;
}

DownloadCounter::increment($validatedServer, $validatedFilename);

header('Location: https://demos.nide.gg/' . rawurlencode($validatedServer) . '/demos/' . rawurlencode($validatedFilename), true, 302);
exit;
?>
