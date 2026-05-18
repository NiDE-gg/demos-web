<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>NIDE.GG | Demos</title>
<link rel="Shortcut Icon" href="favicon.ico" />
<link href="style/css_v2.php" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://code.jquery.com/jquery-4.0.0.min.js"></script>
<script src="https://kit.fontawesome.com/f29912deb4.js" crossorigin="anonymous"></script>
</head>
<body>

<nav>
    <a href="https://demos.nide.gg/" class="nav-brand" title="Demo Archive NiDE.GG">
    <img src="https://demos.nide.gg/style/img/demos_archive_2024.png" alt="Demos Archive NiDE.GG" style="width: 50%;">
    <!-- <div class="brand-icon"></div>
        Demo Archive NiDE.GG
    </a> -->
    <div class="nav-links">
        <a href="https://nide.gg/forums/" title="Go back to Forums">FORUM</a>
        <a href="https://discord.nide.gg/" target="_blank" rel="noopener" title="Discord">DISCORD</a>
        <a href="https://steamcommunity.com/groups/nide_css/" target="_blank" rel="noopener" title="Steam group">STEAM</a>
        <a href="https://stats.nide.gg/" target="_blank" rel="noopener" title="HLStatsX">STATS</a>
        <a href="https://demos.nide.gg/" class="active" title="Demos Archive">DEMOS</a>
        <a href="https://bans.nide.gg/" target="_blank" rel="noopener" title="Sourcebans">BANS</a>
        <a href="https://ebans.nide.gg/" target="_blank" rel="noopener" title="EntWatch bans">EBANS</a>
        <a href="https://kbans.nide.gg/" target="_blank" rel="noopener" title="KbRestrict bans">KBANS</a>
    </div>
</nav>

<div class="container">
    <header>
        <h1>Server Demos</h1>
        <p class="subtitle">Select a server to browse match recordings</p>
    </header>

    <div class="server-grid">
        <?php
        $allowedServers = DemoSecurity::getAllowedServers();
        $colorClasses = ['card-orange', 'card-blue'];
        $colorIndex = 0;
        foreach ($allowedServers as $serverId => $serverInfo): ?>
            <a href="#" class="server-card <?php echo $colorClasses[$colorIndex % count($colorClasses)]; ?> changeServ" data-server="<?php echo DemoSecurity::escapeHtml($serverId); ?>">
                <div class="card-content">
                    <div class="server-badge">
                        <div class="live-dot"></div>
                        CS:Source
                    </div>
                    <div class="server-name"><?php echo DemoSecurity::escapeHtml($serverInfo['name']); ?></div>
                    <div class="card-footer">
                        <span class="action-text">Browse Demos <span class="arrow-icon">→</span></span>
                    </div>
                </div>
            </a>
        <?php $colorIndex++; endforeach; ?>
    </div>

    <div class="info-footer">
        <span class="info-text">
            Demos are automatically deleted after <b>7 days</b>.
        </span>
    </div>

    <div id="server" class="demos-container"></div>
</div>

<script>
$(document).ready(function() {
    function formatLocalDate(unixTimestampSeconds) {
        var date = new Date(unixTimestampSeconds * 1000);
        var parts = new Intl.DateTimeFormat('en-GB', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        }).formatToParts(date);

        var map = {};
        parts.forEach(function(part) {
            map[part.type] = part.value;
        });

        return map.day + '.' + map.month + '.' + map.year + ' @ ' + map.hour + ':' + map.minute;
    }

    function renderLocalTimes(container) {
        var entries = container.querySelectorAll('.demo-date');
        entries.forEach(function(entry) {
            var systemDate = entry.getAttribute('data-system-date') || '';
            var timestamp = parseInt(entry.getAttribute('data-timestamp') || '0', 10);
            if (!timestamp) {
                return;
            }

            var localDate = formatLocalDate(timestamp);
            if (localDate === systemDate) {
                return;
            }

            var localSpan = entry.querySelector('.local-time');
            if (!localSpan) {
                return;
            }

            localSpan.textContent = 'Local: ' + localDate;
            localSpan.classList.remove('hidden');
        });
    }

    // CSRF protection - generate token
    var csrfToken = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);

    $(".changeServ").click(function(event) {
        event.preventDefault();

        // Remove active class from all server cards
        $('.changeServ').removeClass('active-card');

        // Add active class to clicked card
        $(this).addClass('active-card');

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
                    renderLocalTimes(container);
                    // Add animation class and show the demos container
                    container.classList.add('show');
                } else {
                    container.innerHTML = '<div class="error">Error loading demos</div>';
                    container.classList.add('show');
                }
            }
        }

        // Add loading state
        container.classList.add('loading');
        container.classList.remove('show');
        container.innerHTML = '<div style="text-align: center; padding: 50px; color: #888;">Loading demos...</div>';

        req.open("POST", "<?php echo DemoSecurity::escapeHtml(SITE_URL ?? ''); ?>pages/server.php");
        req.send(formData);
    });

    // Auto-select first server on page load if desired
    // Uncomment the next 3 lines if you want auto-selection
    // if ($(".changeServ").length > 0) {
    //     $(".changeServ").first().click();
    // }
});
</script>
