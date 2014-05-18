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

    </body>
</html>
