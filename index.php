<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Nummer music</title>
    </head>

    <script src="js/scripts.js"></script>
    <script>
    var windowWidth; var windowHeigth; var videoIndex; var videoOffset; var videoUrl;
	function getWindowBoundaries()
	{
		var w = window, d = document, e = d.documentElement, g = d.getElementsByTagName('body')[0],
	    width = w.innerWidth || e.clientWidth || g.clientWidth,
	    heigth = w.innerHeight|| e.clientHeight|| g.clientHeight;
	    windowWidth = width; windowHeigth = heigth;
	    debug('Width:' + heigth.toString() + ' Heigth: ' + width.toString());
	}
	function getRandomVideo()
    {
    	videoIndex = Math.floor(1 + Math.random()*2);
    	if (videoIndex == 1) videoOffset = Math.floor(Math.random() * 218);
    	else if (videoIndex ==2 ) videoOffset = Math.floor(Math.random() * 141);
    	videoUrl = "./videos/" + videoIndex + ".mp4#t=" + videoOffset;
    	
	}
	function printVideo()
	{
		var printVideo = " <video autoplay loop id='bgvid'> " +
							"<source src=" + videoUrl + " type='video/mp4'> " + "</video>" ; 
		document.getElementById("bgvid").innerHTML = printVideo;
	}
	function printLinks()
	{
		var xRand = Math.floor((Math.random() * (windowWidth*0.4)) + (windowWidth * 0.25)).toString() + "px ";
		var yRand = Math.floor((Math.random() * (windowHeigth*0.35)) + (windowHeigth * 0.2)).toString() + "px ";
		document.getElementById("textID").style.margin = yRand + " 0px 0px " + xRand ;
	}
 	
	</script>
    
    <body>
		<p id="bgvid"></p>
		<div id="textID">

			<a href='http://www.soundcloud.com/nummer'>soundcloud</a><br>
			<a href="http://www.facebook.com/nummer.music">facebook</a><br>
			<a href="./sequencer.html">lab</a><br>
			<a href="mailto:contact@nummermusic.com">contact</a><br>

		</div>

		<script>
			getWindowBoundaries();
			getRandomVideo();
			printVideo();
			printLinks();
		</script>

    </body>
</html>




