<?php require( "php/app.php") ?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link href="css/lightbox.css" rel="stylesheet" />
		<link rel="icon" type="image/jpg" href="img/favicon14px.jpg">
		<title>NUMMER MUSIC</title>
	</head>
	<script src="/js/scripts.js"></script>
	<script src="/js/jquery-1.11.0.min.js"></script>
	<script src="/js/lightbox.min.js"></script>
	<script>function loadContent(release)
	{
		window.history.replaceState("object or string", "Title", release);
		var xmlhttp;
		if (window.XMLHttpRequest)
		{
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("content").innerHTML=xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","/php/releaseContent.php?release="+release,true);
		xmlhttp.send();
	}
</script>
	<body>
	<div id="videoID"></div>
		<?php
			$releaseCAT = htmlspecialchars($_GET["release"]);
			
			include '/php/db.php';

			$result = mysqli_query($con,"SELECT * FROM Releases WHERE CatalogueNumber = '$releaseCAT'");
			$row = mysqli_fetch_array($result);
		?>
		<div id="header"></div>

		<div id="marginLeft"></div> 
		<div id="content">

			
		</div> 
		<div id="marginRight"></div> 
		<div id="rightNav">
			<?php
				$dir = "releases/";
				if ($handle = opendir($dir)) 
				{	
					$array = array();
		   			while (false !== ($entry = readdir($handle))) 
		   			{
		   				if ($entry != "." && $entry != ".." && $entry != ".DS_Store") 
					    {
					    	$fileUrl = $dir . $entry . "/Artworks/" ;
					    	$artwork = $fileUrl . $entry . ".png ";
					  		echo '<div id="labels" onclick="loadContent(\''.$entry.'\')"><img src=' . $artwork . '></div>';
					  		echo "<p id='labelsText' class='link'>" . $entry . "</p>";
						}
		    		}		
		    	closedir($handle);
				}        	
			?>

		</div>
		<div id="footer"></div>
		<script>
		$( document ).ready(function() 
		{
			if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) )
			{
 				toggleVisibility();
 				document.body.style.backgroundColor = "black";
			}
			else
			{
				getWindowBoundaries();
				getRandomVideo();
				printVideo();
				startVideo();
				var intervalIndex = setInterval(function()
				{
					if (document.getElementById("bgvid").readyState == 4)
					{
						showVideo(1);
						clearInterval(intervalIndex);
					}
				}, 50);
			}
		});
		$("body").click(function()
		{
			toggleVisibility();
		});
		</script>
		<?php
			if ($releaseCAT != "")
			{
				echo '<script type="text/javascript">' , 'loadContent(\''.$releaseCAT.'\');', '</script>';
				echo '<script type="text/javascript">' , 'toggleVisibility();</script>';
			}
		?>
		<script type="text/javascript">
		if ($('html').is('.ie6, .ie7, .ie8')) 
		{
   			document.body.innerHTML = "";
			document.write('<H1><center>Internet Explorer not supported sorry</H1>');
		}
		</script>
	</body>
</html>
