<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Demos Archive - NiDE.GG</title>
<link rel="Shortcut Icon" href="favicon.ico" />
<link href="style/css.php" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://kit.fontawesome.com/f29912deb4.js" crossorigin="anonymous"></script>
</head>
<body>

<div class='header'>
<a href="https://demos.nide.gg/" title="Demo Archive NiDE.GG">
	<img src="https://demos.nide.gg/style/img/demos_archive_2024.png" alt="Demos Archive NiDE.GG">
</a>
</div>
<div class='navbar'>
    <div class='item'>
        <a href='https://nide.gg/forums/' title="Go back to Forums"><i class="fa fa-angle-left mr-1" aria-hidden="true"></i> Back to NiDE.GG</a>
    </div>
    <div class='item'>
        <a href='https://bans.nide.gg/' target="_blank" rel="noopener" title="Sourcebans"><i class="fas fa-ban fa-lg" aria-hidden="true"></i> Sourcebans</a>
    </div>
    <div class='item'>
        <a href='https://stats.nide.gg/' target="_blank" rel="noopener" title="HLStatsX"><i class="fa-solid fa-ranking-star" aria-hidden="true"></i> Stats</a>
    </div>
    <div class='item'>
        <a href='https://donate.nide.gg/' target="_blank" rel="noopener" title="Donate - VIP - Personnal Skin"><i class="fa fa-heartbeat mr-1" aria-hidden="true"></i> Donate</a>
    </div>
</div>
<div class='subbar'>
	<?php
	$allowedServers = DemoSecurity::getAllowedServers();
	foreach ($allowedServers as $serverId => $serverInfo): ?>
		<div class='item changeServ' data-server='<?php echo DemoSecurity::escapeHtml($serverId); ?>'><?php echo DemoSecurity::escapeHtml($serverInfo['name']); ?></div>
	<?php endforeach; ?>
</div>

<script>
$(document).ready(function() {
    // CSRF protection - generate token
    var csrfToken = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);

    $(".changeServ").click(function(event) {
        event.preventDefault();

        // Remove active class and styles from all server buttons
        $('.changeServ').removeClass('active').removeAttr('style');

        // Add active class to clicked button
        $(this).addClass('active');

        var container = document.getElementById("server");
        var serverId = $(this).data('server');

        // Validate server ID on client side
        var allowedServers = ['css_ze', 'css_zr'];
        if (allowedServers.indexOf(serverId) === -1) {
            container.innerHTML = '<div class="error">Invalid server selected</div>';
            return;
        }

        var req = new XMLHttpRequest();

        var formData = new FormData();
        formData.append('server', serverId);
        formData.append('csrf_token', csrfToken);

        req.onreadystatechange = function() {
            if (req.readyState == 4) {
                // Remove loading state
                container.classList.remove('loading');

                if (req.status == 200) {
                    container.innerHTML = req.responseText;
                } else {
                    container.innerHTML = '<div class="error">Error loading demos</div>';
                }
            }
        }

        // Add loading state
        container.classList.add('loading');
        container.innerHTML = '<div style="text-align: center; padding: 50px;">Loading demos...</div>';

        req.open("POST", "<?php echo DemoSecurity::escapeHtml(SITE_URL); ?>pages/server.php");
        req.send(formData);
    });

    // Auto-select first server on page load
    if ($(".changeServ").length > 0) {
        $(".changeServ").first().click();
    }
});
</script>