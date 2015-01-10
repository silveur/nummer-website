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
		<div id="header"></div>

		<div id="marginLeft"></div> 
		<div id="content"></div> 
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
					    	$fileUrl = $dir . $entry . "/" ;
					    	$artwork = $fileUrl . $entry . ".jpg ";
					  		echo "<div id='labels'> <img src=" . $artwork . "></a></div>";
						}
		    		}		
		    	closedir($handle);
				}        	
			?>

		</div>

		<div id="footer"></div>
		<script>
		// $( document ).ready(function() 
		// {
		// 	getWindowBoundaries();
		// 	// getRandomVideo();
		// 	var intervalIndex = setInterval(function()
		// 	{
		// 		// if (document.getElementById("bgvid").readyState == 4)
		// 		// {
		// 		// 	// showVideo(1);
		// 		// 	clearInterval(intervalIndex);
		// 		// }
		// 	}, 50);
		// });
		// $("body").click(function()
		// {
			
		// });
	
		// </script>
	</body>
</html>
