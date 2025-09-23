<?php

include_once('../includes/func.php');

$server = $_POST['server'];

$root = '../';
$demoPath= '/demos/';

$output = shell_exec('cd '.$root.''.$server.''.$demoPath.' && ls -t');

$values = preg_split('/[\n,]+/', $output);
?>

<center>
<table style='width: 100%'>
	<thead>
		<th style='width: 5%; text-align: left'>Map</th>
		<th style='width: 12%; text-align: left'>Date start</th>
		<th style='width: 5%; text-align: center'>Size</th>
		<th style='width: 5%;'></th>
	</thead>
	<tbody>

	<?php		
	$i = 0;
	foreach ($values as $demo)
	{
		if($demo)
		{
			$demoDownload = $demo;
			$demoSizeInBytes = exec("wc -c ".$root."".$server."".$demoPath."".$demoDownload." | awk '{print $1}'");

			$search = array('auto', '-', '.dem');
			$demo = str_replace($search, '', $demo);

			$date = substr($demo, 6, 2).'.'.substr($demo, 4, 2).'.'.substr($demo, 0, 4) . ' @ ' . substr($demo, 8, 2) . ':' . substr($demo, 10, 2);

			$map = substr($demo, 14);

			$demoSize = fileSizeConvert($demoSizeInBytes, 'M').' MiB';

			echo "<tr>";
				echo "<td>".$map."</td>";
				echo "<td>".$date."</td>";
				echo "<td style='text-align: center'>".$demoSize."</td>";
				echo "<td style='text-align: right'><a href='https://demos.nide.gg/".$server."/demos/".$demoDownload."'><div class='button' id='button'>Download</div></a></td>";
			echo "</tr>";
		}
	$i++;	
	}
	?>
	</tbody>
</table>
</center>
