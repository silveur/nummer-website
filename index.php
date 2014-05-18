<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Nummer music</title>
    </head>


    <body>

<?php
	$r=rand(0,270);
	echo $r;

	$vid = "./videos/a.webm#t=" . $r;
	echo $vid;
	echo "<video autoplay loop id='bgvid'>";
	echo "<source src=$vid type='video/webm'>";
	echo "</video>";
?>

    </body>
</html>
