<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css">
		<link href='http://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>
		<title>Nummer music</title>
	</head>

	<script src="js/scripts.js"></script>
	<script>
	var windowWidth; var windowHeigth; var videoIndex; var videoOffset; 
	var videoUrlMp4; var videoUrlWebm; var videoUrlOgg;
	function getWindowBoundaries()
	{
		var w = window, d = document, e = d.documentElement, g = d.getElementsByTagName('body')[0],
		width = w.innerWidth || e.clientWidth || g.clientWidth,
		heigth = w.innerHeight|| e.clientHeight|| g.clientHeight;
		windowWidth = width; windowHeigth = heigth;
		debug('Height:' + heigth.toString() + ' Width: ' + width.toString());
	}
	function getRandomVideo()
	{
		videoIndex = Math.floor(1 + Math.random()*3);
		if (videoIndex == 1) videoOffset = Math.floor(Math.random() * 218);
		else if (videoIndex ==2 ) videoOffset = Math.floor(Math.random() * 141);
		videoUrlMp4 = "./videos/" + videoIndex + ".mp4#t=" + videoOffset + " type='video/mp4'> ";
		videoUrlWebm = "./videos/" + videoIndex + ".webm#t=" + videoOffset + " type='video/webm'> ";
		videoUrlOgg = "./videos/" + videoIndex + ".ogv#t=" + videoOffset + " type='video/ogg'> ";
	}
	function printVideo()
	{
		var printVideo = 	"<video autoplay loop id='bgvid'> " +
							"<source src=" + videoUrlMp4 + 
							"<source src=" + videoUrlWebm +
							"<source src=" + videoUrlOgg + 
							"</video>" ; 
		document.getElementById("bgvid").innerHTML = printVideo;
	}
	function printLinks()
	{
		var x = Math.floor((windowWidth/4)*3).toString() + "px";
		var y = Math.floor(windowHeigth/5).toString() + "px";
		document.getElementById("textID").style.margin = y + " 0px 0px " + x ;
	}
	function printH1()
	{
		var position = (Math.floor((windowHeigth/9))).toString() + "px 0px 0px 0px";
		document.getElementById("header").style.margin = position;
	}
 	
	</script>

	<body>
		<p id="bgvid"></p>
		<div id="header"> NUMMER MUSIC </div>
		<div id="textID">
			<a href='http://www.soundcloud.com/nummer'>soundcloud</a><br>
			<a href="http://www.facebook.com/nummer.music">facebook</a><br>
			<!-- <a href="./sequencer.html">lab</a><br> -->
			<a href="mailto:contact@nummermusic.com">contact</a><br>
		</div>

		<script>
			getWindowBoundaries();
			getRandomVideo();
			printVideo();
			printLinks();
			printH1();
		</script>

	</body>
</html>
