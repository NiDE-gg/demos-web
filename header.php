<title>Demos Archive - NiDE.GG</title>
<link rel="Shortcut Icon" href="favicon.ico" />
<link href="style/css.php" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://kit.fontawesome.com/f29912deb4.js" crossorigin="anonymous"></script>


<div class='header'>
<a href="https://demos.nide.gg/" title="Demo Archive NiDE.GG">
	<img src="https://demos.nide.gg/style/img/demos_archive_2024.png">
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
	<div class='item changeServ' id='css_ze'>CS:S Zombie Escape</div>
	<div class='item changeServ' id='css_zr'>CS:S Zombie Revival</div>
	<!--<div class='item changeServ' id='csgo_ze'>CSGO : Zombie Escape</div>-->
</div>

<script>
$(".changeServ").click(function(event)
{
	$('.changeServ').removeAttr('style');
	$(this).css('background', 'linear-gradient(to left, rgb(0,0,0,0), rgb(0,0,0,.35)), #ff4700 !important');

	var container = document.getElementById("server");
	var req = new XMLHttpRequest();
    
    datas = 'server=' + $(this).attr('id');
    req.onreadystatechange = function()
    {
        if(req.readyState == 4 && req.status == 200)
        {
            container.innerHTML = req.responseText;
        }
    }

    req.open("POST", "<?php echo SITE_URL ?>pages/server.php");
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send(datas);
});
</script>