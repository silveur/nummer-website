<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Nummer music</title>
    </head>


    <body>

<?php
	$vid_index=rand(1,2);
	$vid = "";
	$r = 0;
	if ($vid_index == 1)
	{
		$r=rand(0,218);
		$vid = "./videos/1.mp4#t=" . $r;
	}
	else if ($vid_index == 2)
	{
		$r=rand(0,141);
		$vid = "./videos/2.mp4#t=" . $r;
	}

	echo "<video autoplay loop id='bgvid'>";
	echo "<source src=$vid type='video/mp4'>";
	echo "</video>";
?>
	<div>
		<p><a href="http://www.soundcloud.com/nummer">soundcloud</a></p>
		<p><a href="http://www.facebook.com/nummer.music">facebook</a></p>
		<p><a href="./sequencer.html">lab</a></p>
		<p><a href="mailto:contact@nummermusic.com">contact</a></p>
	</div>

    </body>
</html>
