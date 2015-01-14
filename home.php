<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link href="css/lightbox.css" rel="stylesheet" />
		<link rel="icon" type="image/jpg" href="img/favicon14px.jpg">
		<title>NUMMER MUSIC</title>
	</head>
	<script src="js/scripts.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="js/lightbox.min.js"></script>
	<script>function loadContent(release)
	{
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

			$con=mysqli_connect("localhost","root","root", "Releases");
			if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

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
		   				if ($entry != "." && $entry != ".." && $entry != ".DS_Store" && $entry != "index.php") 
					    {
					    	$fileUrl = $dir . $entry . "/Artworks/" ;
					    	$artwork = $fileUrl . $entry . ".jpg ";
					  		echo '<div id="labels" onclick="loadContent(\''.$entry.'\')"><a href=#><img src=' . $artwork . '></div>';
					  		echo "<p id='labelsText' class='link'>" . $entry . "</p></a>";
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
		});
		$("body").click(function()
		{
			toggleVisibility();
		});
		</script>
		<?php
			mysql_close($con);
		?>
	</body>
</html>
