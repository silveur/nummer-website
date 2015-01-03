<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="icon" type="image/jpg" href="images/favicon14px.jpg">
		<title>NUMMER MUSIC</title>
	</head>
	<script src="js/scripts.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<body>
		<div id="videoID" style="visibility:hidden"></div>
		<?php
			$dir = "releases/";
			echo "<table align='center'>";
			if ($handle = opendir($dir)) 
			{	
				$array = array();
				echo "<tr style='width:100%'>";
	   			while (false !== ($entry = readdir($handle))) 
	   			{
	   				if ($entry != "." && $entry != ".." && $entry != ".DS_Store" && $entry != "index.php") 
				    {
				    	$fileUrl = $dir . $entry . "/" ;
				    	$artwork = $fileUrl . $entry . ".jpg ";
				  		echo "<td>" . "<a href=" . "release.php?release=" . $entry . "><img src=" . $artwork . "></a>" ."</td>";
					}
	    		}		
	    		echo "</tr>";
	    	closedir($handle);
			}        	
			echo "</table>";
		?>
		
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
			
		});
	
		</script>
	</body>
</html>
