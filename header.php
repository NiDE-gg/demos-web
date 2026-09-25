<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>NiDE - Demos Archive</title>
<link rel="Shortcut Icon" href="favicon.ico" />
<link href="style/css_v2.php" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://code.jquery.com/jquery-4.0.0.min.js"></script>
<script src="https://kit.fontawesome.com/f29912deb4.js" crossorigin="anonymous"></script>
</head>
<body>

<nav class="site-nav">
    <div class="nav-inner">
        <input type="checkbox" id="navToggle" class="nav-toggle-input">
        <a href="https://demos.nide.gg/" class="nav-brand" title="Demo Archive NiDE.GG">
            <img src="https://motd.nide.gg/css_ze/imgs/nide_test_nobg_back.png" alt="NiDE" class="brand-icon">
            <span class="nav-brand__text">
                <span class="nav-brand__name">NiDE</span>
                <span class="nav-brand__tag">Demos Archive</span>
            </span>
        </a>
        <label for="navToggle" class="nav-toggle" aria-label="Toggle navigation">
            <svg class="icon-open" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
            <svg class="icon-close" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M6 6l12 12M18 6L6 18"/></svg>
        </label>
        <div class="nav-menu">
            <div class="nav-links">
                <a href="https://nide.gg/forums/" title="Go back to Forums"><i class="fas fa-comments"></i> Forum</a>
                <a href="https://demos.nide.gg/" class="active" title="Demos Archive"><i class="fas fa-film"></i> Demos</a>
                <a href="https://stats.nide.gg/" target="_blank" rel="noopener" title="HLStatsX"><i class="fas fa-chart-line"></i> Stats</a>
                <a href="https://bans.nide.gg/" target="_blank" rel="noopener" title="Sourcebans"><i class="fas fa-ban"></i> Bans</a>
                <a href="https://ebans.nide.gg/" target="_blank" rel="noopener" title="EntWatch bans"><i class="fas fa-hand-paper"></i> EBans</a>
                <a href="https://kbans.nide.gg/" target="_blank" rel="noopener" title="KbRestrict bans"><i class="fas fa-user-slash"></i> KBans</a>
            </div>
            <div class="nav-actions">
                <a href="https://discord.nide.gg/" target="_blank" rel="noopener" class="nav-pill" title="Discord"><i class="fab fa-discord"></i> Discord</a>
                <a href="https://nide.gg/" class="nav-pill" title="NiDE Community">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 18l-6-6 6-6"/></svg>
                    Back to NiDE.GG
                </a>
            </div>
        </div>
    </div>
</nav>

<div class="container">
    <header class="page-head">
        <div>
            <span class="page-head__eyebrow">CS:Source recordings</span>
            <h1 class="page-head__title">Server Demos</h1>
            <p class="page-head__sub">Pick a server to browse and download its match recordings, newest first.</p>
        </div>
        <div class="page-head__actions">
            <span class="info-pill">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
                Demos are deleted after&nbsp;<strong>7 days</strong>
            </span>
        </div>
    </header>

    <div class="server-grid">
        <?php
        $tileIcons = [
            'css_ze' => '<path d="M3 10l1 2h6"/><path d="M12 9a2 2 0 0 0 -2 2v3c0 1.1 .9 2 2 2h7a2 2 0 0 0 2 -2c0 -3.31 -3.13 -5 -7 -5h-2"/><path d="M13 9l0 -3"/><path d="M5 6l15 0"/><path d="M15 9.1v3.9h5.5"/><path d="M15 19l0 -3"/><path d="M19 19l-8 0"/>',
            'css_zr' => '<circle cx="12" cy="11" r="7"/><path d="M9 9l-2 2m2 0l-2 -2"/><path d="M15 11l0 .01"/><path d="M9 15q1.5 1.5 3 0q1.5 1.5 3 0"/><path d="M8 18l-1 2M16 18l1 2"/>',
        ];
        $defaultIcon = '<rect x="3" y="4" width="18" height="16" rx="2"/><path d="M10 9v6l5-3z"/>';
        $tileClasses = ['server-tile--orange', 'server-tile--blue'];
        $tileIndex = 0;
        foreach (DemoSecurity::getAllowedServers() as $serverId => $serverInfo) : ?>
            <a href="#" class="server-tile <?php echo $tileClasses[$tileIndex % count($tileClasses)]; ?> changeServ" data-server="<?php echo DemoSecurity::escapeHtml($serverId); ?>">
                <div class="server-tile__top">
                    <span class="server-tile__chip">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $tileIcons[$serverId] ?? $defaultIcon; ?></svg>
                    </span>
                    <span class="badge">CS:Source</span>
                </div>
                <div>
                    <div class="server-tile__name"><?php echo DemoSecurity::escapeHtml($serverInfo['name']); ?></div>
                    <div class="server-tile__id"><?php echo DemoSecurity::escapeHtml($serverId); ?></div>
                </div>
                <div class="server-tile__foot">
                    Browse recordings
                    <span class="server-tile__arrow">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                    </span>
                </div>
            </a>
            <?php $tileIndex++;
        endforeach; ?>
    </div>

    <div class="list-head hidden" id="tableToolbar">
        <div>
            <h2 class="section-title" id="listTitle">Recordings</h2>
            <p class="section-sub">Server time (Paris), with your local time when it differs.</p>
        </div>
        <div class="list-tools">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="demoSearch" placeholder="Search by map or date..." autocomplete="off" aria-label="Search demos">
                <button type="button" class="search-clear" id="searchClear" title="Clear search" aria-label="Clear search"><i class="fas fa-times"></i></button>
            </div>
            <div class="demo-count" id="demoCount"></div>
        </div>
    </div>

    <div id="server" class="demos-container demo-list"></div>
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

    var toolbar = document.getElementById('tableToolbar');
    var searchInput = document.getElementById('demoSearch');
    var searchClear = document.getElementById('searchClear');
    var demoCount = document.getElementById('demoCount');

    function filterDemos() {
        var query = (searchInput.value || '').trim().toLowerCase();
        searchClear.classList.toggle('visible', query.length > 0);

        var rows = document.querySelectorAll('#server .demo-row');
        var visibleCount = 0;

        rows.forEach(function(row) {
            var haystack = row.getAttribute('data-search') || '';
            var match = query === '' || haystack.indexOf(query) !== -1;
            row.style.display = match ? '' : 'none';
            if (match) {
                visibleCount++;
            }
        });

        var noResults = document.getElementById('noSearchResults');
        if (noResults) {
            noResults.style.display = (rows.length > 0 && visibleCount === 0) ? 'block' : 'none';
        }

        if (demoCount) {
            if (rows.length === 0) {
                demoCount.textContent = '';
            } else {
                demoCount.textContent = visibleCount + ' / ' + rows.length + ' demo' + (rows.length !== 1 ? 's' : '');
            }
        }
    }

    searchInput.addEventListener('input', filterDemos);
    searchClear.addEventListener('click', function() {
        searchInput.value = '';
        filterDemos();
        searchInput.focus();
    });

    $(".changeServ").click(function(event) {
        event.preventDefault();

        // Remove active class from all server cards
        $('.changeServ').removeClass('active-card');

        // Add active class to clicked card
        $(this).addClass('active-card');

        var container = document.getElementById("server");
        var serverId = $(this).data('server');
        $('#listTitle').text($(this).find('.server-tile__name').text());

        // Validate server ID on client side
        var allowedServers = ['css_ze', 'css_zr'];
        if (allowedServers.indexOf(serverId) === -1) {
            container.innerHTML = '<div class="error">Invalid server selected</div>';
            return;
        }

        var req = new XMLHttpRequest();

        var formData = new FormData();
        formData.append('server', serverId);

        req.onreadystatechange = function() {
            if (req.readyState == 4) {
                // Remove loading state
                container.classList.remove('loading');

                if (req.status == 200) {
                    container.innerHTML = req.responseText;
                    renderLocalTimes(container);
                    // Add animation class and show the demos container
                    container.classList.add('show');

                    // Reset and reveal the search toolbar for the newly loaded list
                    searchInput.value = '';
                    searchClear.classList.remove('visible');
                    toolbar.classList.remove('hidden');
                    filterDemos();
                } else {
                    container.innerHTML = '<div class="error">Error loading demos</div>';
                    container.classList.add('show');
                    toolbar.classList.add('hidden');
                }
            }
        }

        // Add loading state
        toolbar.classList.add('hidden');
        container.classList.add('loading');
        container.classList.remove('show');
        container.innerHTML = '<div class="demo-loading"><span class="demo-loading__spinner"></span>Loading demos...</div>';

        req.open("POST", "<?php echo DemoSecurity::escapeHtml(SITE_URL); ?>pages/server.php");
        req.send(formData);
    });

    // Auto-select first server on page load if desired
    // Uncomment the next 3 lines if you want auto-selection
    // if ($(".changeServ").length > 0) {
    //     $(".changeServ").first().click();
    // }
});
</script>
