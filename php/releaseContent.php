<?php
			$releaseCAT = htmlspecialchars($_GET["release"]);
			$pwd = file_get_contents('../../pwd', true);
			$usr = file_get_contents('../../usr', true);
			$pwd=preg_replace('/\s+/', '', $pwd);
			$usr=preg_replace('/\s+/', '', $usr);		
			$con=mysqli_connect("localhost",$usr, $pwd, "NummerWebsite");
			if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

			$result = mysqli_query($con,"SELECT * FROM Releases WHERE CatalogueNumber = '$releaseCAT'");
			$row = mysqli_fetch_array($result);
		?>
		<div id="releaseVideo">
				<?php echo $row['VideoLink'];?>
			</div>
			<div id="releaseInfos">
				<?php
				if ($releaseCAT != "")
				{
					echo "<h2>" . $row['ReleaseName'] . "</h2>";
					echo $row['RecordLabel'] . " - " . $row['CatalogueNumber'];
					if ($releaseCAT == "NUMM01")
						echo '</br>Expected shipping 1st March';					
echo "<br>£" . $row['Price'];
					$inStock = $row['Inventory'];
					if($inStock < 10 && $inStock != 0) echo "</br>In stock: " . "<span style='color: red'> " . $row['Inventory'] . "</span>";
					
					if($row['Inventory'] == 0) echo "</br><span style='color: red'>Sold out</span>";
					else 
					{
						// echo '<br><a href="#" id="orderButton" " >Pre-order</a>';
						$onClick = 'onClick="paypalOrder(\'' . $releaseCAT . '\', \'' .$row['Price'] . '\')"';
						// echo $onClick;
						
						echo '<br><a href="#" id="orderButton"' . $onClick . ' >Pre-order</a>';

						?>
							<!-- <br><a href="#" id="orderButton" >Pre-order</a> -->
						<?php
					}

					echo "<p>For grouped orders please contact us by email: <span><a href='mailto:contact@nummermusic.com'>contact@nummermusic.com </a></span> </p>";
					echo "Tracklist: <br>" . $row['Tracklist'];
				}
				?>
			</div>
				<div id="releasePictures">
				<?php
				$phpdir = "../releases/" . $releaseCAT . "/Artworks/";
				$htmldir = "/releases/" . $releaseCAT . "/Artworks/";
				if ($handle = opendir($phpdir)) 
				{	
		   			while (false !== ($entry = readdir($handle))) 
		   			{
		   				if ($entry != "." && $entry != ".." && $entry != ".DS_Store") 
					    {
					    	$fileUrl = $htmldir . $entry ;
					  		if ($entry != ($releaseCAT. ".png"))
					  			echo "<a href='" . $fileUrl . "' data-lightbox='releaseArtworks' data-title='Artworks'>" . "<img src=" . $fileUrl . ">" . "</a>";
						}
		    		}		
		    	closedir($handle);
				}        	
				else
				{
					echo 'Cant open dir';
				}
			?>
			</div>