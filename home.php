<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link href="css/lightbox.css" rel="stylesheet" />
		<link rel="icon" type="image/jpg" href="images/favicon14px.jpg">
		<title>NUMMER MUSIC</title>
	</head>
	<script src="js/scripts.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="js/lightbox.min.js"></script>
	<body>
	<!-- <div id="videoID"></div> -->
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

			<div id="releaseVideo">
				<?php echo $row['VideoLink'];?>
			</div>
			<div id="releaseInfos">
				<?php
				if ($releaseCAT != "")
				{
					echo "<h2>" . $row['ReleaseName'] . "</h2>";
					echo $row['RecordLabel'] . " - " . $row['CatalogueNumber'];
					echo "<br>£" . $row['Price'];
					$inStock = $row['Inventory'];
					if($inStock < 10 && $inStock != 0) echo "</br>In stock: " . "<span style='color: red'> " . $row['Inventory'] . "</span>";
					
					if($row['Inventory'] == 0) echo "</br><span style='color: red'>Sold out</span>";
					else
					{
						echo "<br><a href='#' id='orderButton' onclick='orderMenuSetVisible()'>Order</a>";

						echo "<div id='orderForm'>";
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
								<textarea type="text" cols="30" rows="5" name="address" required></textarea>
								<br>
								<input type="radio" name="zone" value="UK" checked>United Kingdom £3.5
								<br>
								<input type="radio" name="zone" value="EU">Europe £5
								<br>
								<input type="radio" name="zone" value="RW">Rest of the world £9
								<br><br>
								<input type="submit" value="Submit">
								</form>
							<?php 
						echo "</div>";		
						echo "<p>For grouped orders please contact us by email: <span><a href='mailto:contact@nummermusic.com'>contact@nummermusic.com </a></span> </p>";
					}
				}
				?>
			</div>
				<div id="releasePictures">
				<?php
				$dir = "releases/" . $releaseCAT . "/Artworks/";
				if ($handle = opendir($dir)) 
				{	
		   			while (false !== ($entry = readdir($handle))) 
		   			{
		   				if ($entry != "." && $entry != ".." && $entry != ".DS_Store") 
					    {
					    	$fileUrl = $dir . $entry ;
					  		if ($entry != ($releaseCAT. ".jpg"))
					  		echo "<a href='" . $fileUrl . "' data-lightbox='releaseArtworks' data-title='Artworks'>" . "<img src=" . $fileUrl . ">" . "</a>";
						}
		    		}		
		    	closedir($handle);
				}        	
			?>
			</div>

			<div id="tracklist">
				<?php
				if ($releaseCAT != "")
				{
					echo "Tracklist: <br>" . $row['Tracklist'];
					mysql_close($con);
				}
				?>
			</div>

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
					  		echo "<div id='labels'> <a href='?release=" . $entry . "'><img src=" . $artwork . "></div>";
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
			
		});
		</script>
		<?php
			mysql_close($con);
		?>
	</body>
</html>
