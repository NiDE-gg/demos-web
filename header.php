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

<nav>
    <input type="checkbox" id="navToggle" class="nav-toggle-input">
    <a href="https://demos.nide.gg/" class="nav-brand" title="Demo Archive NiDE.GG">
        <img src="https://motd.nide.gg/css_ze/imgs/nide_test_nobg_back.png" alt="NiDE" class="brand-icon">
        <span class="nav-brand-text">
            <span class="nav-brand-name">NiDE</span>
            <span class="nav-brand-tag">Demos Archive</span>
        </span>
    </a>
    <label for="navToggle" class="nav-toggle" aria-label="Open menu">
        <i class="fas fa-bars"></i>
    </label>
    <div class="nav-menu">
        <div class="nav-links">
            <a href="https://nide.gg/forums/" title="Go back to Forums">Forum</a>
            <a href="https://demos.nide.gg/" class="active" title="Demos Archive">Demos</a>
            <a href="https://stats.nide.gg/" target="_blank" rel="noopener" title="HLStatsX">Stats</a>
            <a href="https://bans.nide.gg/" target="_blank" rel="noopener" title="Sourcebans">Bans</a>
            <a href="https://steamcommunity.com/groups/nide_css/" target="_blank" rel="noopener" title="Steam group">Steam</a>
        </div>
        <a href="https://discord.nide.gg/" target="_blank" rel="noopener" class="nav-cta" title="Discord">
            <i class="fab fa-discord"></i>
            Discord
        </a>
    </div>
</nav>

<div class="container">
    <header>
        <span class="header-eyebrow">
            <span class="live-dot"></span>
            CS:Source Community
        </span>
        <h1>Server Demos</h1>
        <p class="subtitle">Select a server to browse match recordings</p>
    </header>

    <div class="server-grid">
        <?php
        $allowedServers = DemoSecurity::getAllowedServers();
        $colorClasses = ['card-orange', 'card-blue'];
        $colorIndex = 0;
        foreach ($allowedServers as $serverId => $serverInfo) : ?>
            <a href="#" class="server-card <?php echo $colorClasses[$colorIndex % count($colorClasses)]; ?> changeServ" data-server="<?php echo DemoSecurity::escapeHtml($serverId); ?>">
                <div class="card-content">
                    <div class="server-badge">
                        <div class="live-dot"></div>
                        CS:Source
                    </div>
                    <div class="server-name"><?php echo DemoSecurity::escapeHtml($serverInfo['name']); ?></div>
                </div>
                <div class="card-footer">
                    <span class="action-text">Browse demos <span class="arrow-icon">→</span></span>
                </div>
            </a>
            <?php $colorIndex++;
        endforeach; ?>
    </div>

    <div class="info-footer">
        <span class="info-text">
            <i class="fas fa-clock"></i>
            Demos are automatically deleted after <strong>7 days</strong>.
        </span>
    </div>

    <div class="how-it-works">
        <div class="step-card">
            <span class="step-number">01</span>
            <span class="step-title">Choose a server</span>
            <p class="step-text">Pick Zombie Escape or Zombie Revival above.</p>
        </div>
        <div class="step-card">
            <span class="step-number">02</span>
            <span class="step-title">Browse recordings</span>
            <p class="step-text">Search recent matches by map or date.</p>
        </div>
        <div class="step-card">
            <span class="step-number">03</span>
            <span class="step-title">Download &amp; watch</span>
            <p class="step-text">Grab the .dem file and replay it in-game.</p>
        </div>
    </div>

    <div class="table-toolbar hidden" id="tableToolbar">
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="demoSearch" placeholder="Search by map or date..." autocomplete="off">
            <button type="button" class="search-clear" id="searchClear" title="Clear search"><i class="fas fa-times"></i></button>
        </div>
        <div class="demo-count" id="demoCount"></div>
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
        container.innerHTML = '<div style="text-align: center; padding: 50px; color: #888;">Loading demos...</div>';

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
