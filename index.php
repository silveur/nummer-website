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
	    windowWidth = w.innerWidth || e.clientWidth || g.clientWidth,
	    windowHeigth = w.innerHeight|| e.clientHeight|| g.clientHeight;
	    debug('Width:' + windowHeigth.toString() + ' Heigth: ' + windowWidth.toString());
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

		debug('video: ' + printVideo);
		document.getElementById("bgvid").innerHTML = printVideo;
	}
 
	</script>
    


    <body>
    	

	<p id="bgvid"></p>

<!-- 	<div>
		<p><a href="http://www.soundcloud.com/nummer">soundcloud</a></p>
		<p><a href="http://www.facebook.com/nummer.music">facebook</a></p>
		<p><a href="./sequencer.html">lab</a></p>
		<p><a href="mailto:contact@nummermusic.com">contact</a></p>
	</div> -->
	<script>getWindowBoundaries();getRandomVideo();printVideo();</script>
    </body>
</html>




