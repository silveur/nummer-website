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
	<!-- <div id="videoID"></div> -->
		<?php
			$releaseCAT = "PBR004";//htmlspecialchars($_GET["release"]);

			$con=mysqli_connect("localhost","root","root", "Releases");
			if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

			$result = mysqli_query($con,"SELECT * FROM Releases WHERE CatalogueNumber = '$releaseCAT'");
			$row = mysqli_fetch_array($result);
			?>
		<div id="header"></div>

		<div id="marginLeft"></div> 
		<div id="content">

			<div id="releaseVideo">
				<?php echo $row['VideoLink'];?>

			</div>
			<div id="releaseInfos">
			<?php
			echo "</br>Release name: " . $row['ReleaseName'];
			echo "</br>Record label: " . $row['RecordLabel'];
			echo "</br>Catalogue number: " . $row['CatalogueNumber'];
			echo "</br>Inventory: " . $row['Inventory'];
			echo "</br>Price: £" . $row['Price'];
			if($row['Inventory'] == 0) echo "</br>Sold out";
			else
			{
				echo "<form required action='/php/order.php' method='pre'>";
				echo "<input type='hidden' name='cat' value=" . $releaseCAT . ">";
				echo "<input type='hidden' name='price' value=" . $row['Price'] . ">";
				?>		
 				First and last name:<br>
					<input type="text" name="name" required>
					<br>
					Email address:<br>
					<input type="email" name="email" required>
					<br>
					Delivery address:<br>
					<input type="text" name="address" required>
					<br>
					<input type="radio" name="zone" value="UK" checked>United Kingdom £3.5
					<br>
					<input type="radio" name="zone" value="EU">Europe £5
					<br>
					<input type="radio" name="zone" value="RW">Rest of the world £9
					<br>
					<input type="submit" value="Submit">
					</form>
				<?php 

			}
			mysql_close($con);
		?>
			</div>
						<div id="releasePictures">
				<img src="releases/GOOD-05/GOOD-05.jpg">
				<img src="releases/NUMM01/NUMM01.jpg">
			</div>
			<div id="tracklist">
				s parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque 
			</div>


		</div> 
		<!-- <div id="marginRight"></div>  -->
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
