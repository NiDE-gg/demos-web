<?php
include_once('../includes/func.php');
include_once('../includes/security.php');
include_once('../includes/downloads.php');

// Validate and sanitize server input
$server = $_POST['server'] ?? '';
$validatedServer = DemoSecurity::validateServer($server);

if (!$validatedServer) {
    DemoSecurity::logSecurityEvent('Invalid server parameter', $server);
    http_response_code(400);
    echo '<div class="error">Invalid server parameter</div>';
    exit;
}

$root = '../';
$demoPath = $root . $validatedServer . '/demos/';

// Check if demo directory exists
if (!is_dir($demoPath)) {
    echo '<div class="error">Demo directory not found: ' . htmlspecialchars($demoPath) . '</div>';
    exit;
}

// Use secure directory listing instead of shell_exec
$demos = [];
if ($handle = opendir($demoPath)) {
    while (($file = readdir($handle)) !== false) {
        if ($file != "." && $file != ".." && is_file($demoPath . $file)) {
            // Validate filename pattern for demo files
            if (DemoSecurity::sanitizeFilename($file)) {
                $demos[] = [
                    'filename' => $file,
                    'mtime' => filemtime($demoPath . $file)
                ];
            }
        }
    }
    closedir($handle);
}

// Sort by modification time (newest first)
usort($demos, function($a, $b) {
    return $b['mtime'] - $a['mtime'];
});

// Self-cleaning: drop counters for demos that no longer exist on disk
// (the external recorder script prunes files every 7 days).
DownloadCounter::prune($validatedServer, array_column($demos, 'filename'));
$downloadCounts = DownloadCounter::getCounts($validatedServer);
?>
<div class="demo-list-header">
    <div class="demo-col demo-col-map">Map</div>
    <div class="demo-col demo-col-date">Date start</div>
    <div class="demo-col demo-col-size">Size</div>
    <div class="demo-col demo-col-action">Download</div>
</div>
<div class="demo-list-body">
<?php
foreach ($demos as $demoInfo) {
    $demo = $demoInfo['filename'];
    $demoPath_full = $demoPath . $demo;

    // Get file size safely
    $demoSizeInBytes = filesize($demoPath_full);
    if ($demoSizeInBytes === false) {
        continue; // Skip if file size cannot be determined
    }

    // Extract date and map from filename (format: auto-YYYYMMDD-HHMMSS-mapname.dem(.bz2)?)
    if (preg_match('/^auto-(\d{4})(\d{2})(\d{2})-(\d{2})(\d{2})(\d{2})-(.+)\.dem(\.bz2)?$/', $demo, $matches)) {
        $year = $matches[1];
        $month = $matches[2];
        $day = $matches[3];
        $hour = $matches[4];
        $minute = $matches[5];
        $second = $matches[6];
        $map = $matches[7];

        $date = "$day.$month.$year @ $hour:$minute";
        $timestamp = mktime((int)$hour, (int)$minute, (int)$second, (int)$month, (int)$day, (int)$year);
    } else {
        // Fallback for unexpected filename format
        $date = date('d.m.Y @ H:i', $demoInfo['mtime']);
        $timestamp = (int)$demoInfo['mtime'];
        $map = 'Unknown';
    }

    $demoSize = fileSizeConvert($demoSizeInBytes, 'M') . ' MiB';

    // Searchable haystack combining map name and date
    $searchKey = strtolower($map . ' ' . $date);

    echo "<div class='demo-row' data-search='" . DemoSecurity::escapeHtml($searchKey) . "'>";
        echo "<div class='demo-col demo-col-map'>";
            echo "<div class='demo-icon'><i class='fas fa-file-video'></i></div>";
            echo "<span class='demo-map-name' title='" . DemoSecurity::escapeHtml($map) . "'>" . DemoSecurity::escapeHtml($map) . "</span>";
        echo "</div>";
        echo "<div class='demo-col demo-col-date'>";
            echo "<div class='demo-date' data-system-date='" . DemoSecurity::escapeHtml($date) . "' data-timestamp='" . (int)$timestamp . "'><span class='system-time'>" . DemoSecurity::escapeHtml($date) . "</span><span class='local-time hidden'></span></div>";
        echo "</div>";
        echo "<div class='demo-col demo-col-size'>";
            echo "<span class='size-badge'>" . DemoSecurity::escapeHtml($demoSize) . "</span>";
        echo "</div>";
        echo "<div class='demo-col demo-col-action'>";
            $downloadCount = $downloadCounts[$demo] ?? 0;
            echo "<a href='" . SITE_URL . "pages/download.php?server=" . urlencode($validatedServer) . "&file=" . urlencode($demo) . "'><div class='button'><i class='fas fa-download'></i> Download</div></a>";
            echo "<span class='download-count' title='Downloads'><i class='fas fa-arrow-down'></i> " . (int)$downloadCount . "</span>";
        echo "</div>";
    echo "</div>";
}

if (empty($demos)) {
    echo "<div class='empty-state'>";
        echo "<i class='fas fa-folder-open'></i>";
        echo "<h3>No demos available in this server</h3>";
    echo "</div>";
}
?>
</div>
<div class="empty-state" id="noSearchResults" style="display:none;">
    <i class="fas fa-search"></i>
    <h3>No demos match your search</h3>
</div>
