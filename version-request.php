
<?php

$latest = '0.8';
$toCheck = htmlspecialchars($_GET["version"]);
$toCheck = str_replace('.','', $toCheck);
$latest = str_replace('.','', $latest);
if ($latest > $toCheck)
{
	echo 'http://nummermusic.com/sequencer.zip';
}
else
{
	echo 'null';
}
?>

