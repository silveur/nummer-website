

function debug(stringToPrint)
{
	console.debug(stringToPrint);
}
	
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-51181390-1', 'nummermusic.com');
		ga('send', 'pageview');

var windowWidth; var windowHeigth; var videoIndex; var videoOffset; 
var videoUrlMp4; var videoUrlWebm; var videoUrlOgg; var video;
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
	if (videoIndex == 1) videoOffset = 2 + (Math.floor(Math.random() * 60));
	else if (videoIndex == 2 ) videoOffset = 2 + (Math.floor(Math.random() * 60));
	else if (videoIndex == 3 ) videoOffset = 2 + (Math.floor(Math.random() * 45));
	videoUrlMp4 = "./videos/" + videoIndex + ".mp4#t=" + videoOffset + " type='video/mp4'> ";
	videoUrlWebm = "./videos/" + videoIndex + ".webm#t=" + videoOffset + " type='video/webm'> ";
	videoUrlOgg = "./videos/" + videoIndex + ".ogv#t=" + videoOffset + " type='video/ogg'> ";
}
function printVideo()
{
	var printVideo = 	"<video loop preload='auto' id='bgvid'> " +
						"<source src=" + videoUrlMp4 + 
						"<source src=" + videoUrlWebm +
						"<source src=" + videoUrlOgg + 
						"</video>" ; 
	document.getElementById("videoID").innerHTML = printVideo;
}
function startVideo()
{
	$('#bgvid').get(0).play();
}
function printLinks()
{
	var x = Math.floor((windowWidth/4)*3).toString() + "px";
	var y = Math.floor(windowHeigth/5).toString() + "px";
	// document.getElementById("textID").style.display = "none";
	document.getElementById("textID").style.margin = y + " 0px 0px " + x ;			
}
function toggleArrowsVisibility()
{
	var arrows = document.getElementById("main");
	if(document.defaultView && document.defaultView.getComputedStyle)
	{
		if (arrows.style.visibility == "hidden") { arrows.style.visibility = "visible"; }
		else { arrows.style.visibility = "hidden";}				
	}
}
function toggleVisibility()
{
	var oElm = document.getElementById("textID"); var strValue;
	if(document.defaultView && document.defaultView.getComputedStyle)
	{
		strValue = document.defaultView.getComputedStyle(oElm, null).getPropertyValue("display");
		if (oElm.style.visibility == "hidden") { oElm.style.visibility = "visible";}
		else { oElm.style.visibility = "hidden";}				
	}
}
function showVideo(state)
{
	if (state)
		document.getElementById("videoID").style.visibility="visible";
	else
		document.getElementById("videoID").style.visibility="hidden";
}
function showVimeo(state)
{
	if (state)
	{
		showVideo(0);
		var printVimeo = "<iframe src='//player.vimeo.com/video/95671503?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff&amp;autoplay=1' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>"; 
		document.getElementById("vimeoID").innerHTML = printVimeo;
		document.getElementById("main").style.visibility = "visible";
		var x = Math.floor((windowWidth/4)*2).toString() + "px";
		var y = Math.floor(windowHeigth/1.5).toString() + "px";
		document.getElementById("vimeoID").style.width = x;	
		document.getElementById("vimeoID").style.left = (windowWidth/4).toString() + "px";	
		document.getElementById("vimeoID").style.height = y;
		document.getElementById("vimeoID").style.top = (windowHeigth/5).toString() + "px";	
		document.getElementById("vimeoID").style.visibility="visible";
	}
	else
	{
		document.getElementById("vimeoID").innerHTML = "";
		document.getElementById("vimeoID").style.visibility="hidden";
		showVideo(1);
	}
}

function backToMain()
{
	document.getElementById("main").style.visibility = "hidden";
	showVimeo(0);
}
