<?php
include_once('../includes/func.php');
include_once('../includes/security.php');

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
?>

<table>
	<thead>
		<tr>
			<th style='text-align: left'>Map</th>
			<th style='text-align: left'>Date start</th>
			<th style='text-align: left'>Size</th>
			<th style='text-align: center'>Download</th>
		</tr>
	</thead>
	<tbody>

	<?php
	foreach ($demos as $demoInfo) {
		$demo = $demoInfo['filename'];
		$demoPath_full = $demoPath . $demo;

		// Get file size safely
		$demoSizeInBytes = filesize($demoPath_full);
		if ($demoSizeInBytes === false) {
			continue; // Skip if file size cannot be determined
		}

		// Parse demo filename for display
		$demoDisplay = str_replace(['auto-', '.dem'], '', $demo);

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
		} else {
			// Fallback for unexpected filename format
			$date = date('d.m.Y @ H:i', $demoInfo['mtime']);
			$map = 'Unknown';
		}

		$demoSize = fileSizeConvert($demoSizeInBytes, 'M') . ' MiB';

		// Add compression indicator if file is compressed
		if (strpos($demo, '.bz2') !== false) {
			$demoSize .= ' (bz2)';
		}

		echo "<tr>";
			echo "<td>" . DemoSecurity::escapeHtml($map) . "</td>";
			echo "<td>" . DemoSecurity::escapeHtml($date) . "</td>";
			echo "<td>" . DemoSecurity::escapeHtml($demoSize) . "</td>";
			echo "<td style='text-align: center !important'><a href='https://demos.nide.gg/" . urlencode($validatedServer) . "/demos/" . urlencode($demo) . "'><div class='button'>Download</div></a></td>";
		echo "</tr>";
	}

	if (empty($demos)) {
		echo "<tr><td colspan='4' style='text-align: center; padding: 20px;'>No demos available in: " . htmlspecialchars($demoPath) . "</td></tr>";
	}
	?>
	</tbody>
</table>
<?php
include_once('../includes/func.php');
include_once('../includes/security.php');

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
?>

<table>
	<thead>
		<tr>
			<th style='text-align: left'>Map</th>
			<th style='text-align: left'>Date start</th>
			<th style='text-align: left'>Size</th>
			<th style='text-align: center'>Download</th>
		</tr>
	</thead>
	<tbody>

	<?php
	foreach ($demos as $demoInfo) {
		$demo = $demoInfo['filename'];
		$demoPath_full = $demoPath . $demo;

		// Get file size safely
		$demoSizeInBytes = filesize($demoPath_full);
		if ($demoSizeInBytes === false) {
			continue; // Skip if file size cannot be determined
		}

		// Parse demo filename for display
		$demoDisplay = str_replace(['auto-', '.dem'], '', $demo);

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
		} else {
			// Fallback for unexpected filename format
			$date = date('d.m.Y @ H:i', $demoInfo['mtime']);
			$map = 'Unknown';
		}

		$demoSize = fileSizeConvert($demoSizeInBytes, 'M') . ' MiB';

		// Add compression indicator if file is compressed
		if (strpos($demo, '.bz2') !== false) {
			$demoSize .= ' (bz2)';
		}

		echo "<tr>";
			echo "<td>" . DemoSecurity::escapeHtml($map) . "</td>";
			echo "<td>" . DemoSecurity::escapeHtml($date) . "</td>";
			echo "<td>" . DemoSecurity::escapeHtml($demoSize) . "</td>";
			echo "<td style='text-align: center !important'><a href='https://demos.nide.gg/" . urlencode($validatedServer) . "/demos/" . urlencode($demo) . "'><div class='button'>Download</div></a></td>";
		echo "</tr>";
	}

	if (empty($demos)) {
		echo "<tr><td colspan='4' style='text-align: center; padding: 20px;'>No demos available in: " . htmlspecialchars($demoPath) . "</td></tr>";
	}
	?>
	</tbody>
</table>
