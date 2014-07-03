
<?php

$latest = '1.1.0';
$toCheck = htmlspecialchars($_GET["version"]);
$toCheck = str_replace('.','', $toCheck);
$latest = str_replace('.','', $latest);
if ($latest > $toCheck)
{
	echo 'http://nummermusic.com/Steps.zip';
}
else
{
	echo 'null';
}
?>

