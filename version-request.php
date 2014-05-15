
<?php

$latest = '0.9';
$toCheck = htmlspecialchars($_GET["version"]);
$toCheck = str_replace('.','', $toCheck);
$latest = str_replace('.','', $latest);
if ($latest > $toCheck)
{
	echo 'http://nummermusic.com/Sequencer.zip';
}
else
{
	echo 'null';
}
?>

