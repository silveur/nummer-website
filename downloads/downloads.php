<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="../style.css">
		<link rel="icon" type="image/jpg" href="images/favicon14px.jpg">
		<title>Downloads</title>
	</head>
	<script src="js/scripts.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<body>
		<?php

		$Voucher = htmlspecialchars($_GET["code"]);

		$con=mysqli_connect("localhost","root","root", "AudioDownloads");
		if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

		$result = mysqli_query($con,"SELECT * FROM Voucher
		WHERE Code='$Voucher'");

		if(mysqli_num_rows($result) == 0) 
		{
			echo "<H2> <center> Sorry but no audio files were found for your download code </H2>";
		} 
		else 
		{
			$row = mysqli_fetch_array($result);
			$credit = $row['Credit'];
			
			if ($credit != "ALL")
			{
				$dir = "../audio/" . $credit;
				echo "<center> <img style='height:auto; width:auto; max-width:300px; max-height:300px;' src=" . $dir . "/artwork.jpg" . ">";
				echo "<center><table border='1'";   		
				if ($handle = opendir($dir)) 
				{	
		   			while (false !== ($entry = readdir($handle))) 
		   			{
		       			if ($entry != "." && $entry != ".." && $entry != ".DS_Store") 
				        {
				        	$fileUrl = $dir . "/" . $entry ;
				        	$fileUrl = str_replace(' ', '%20', $fileUrl);
				        	$extension = pathinfo($fileUrl);
				        	if ($extension['extension'] == "zip")
				        	{
				        		echo "<p><a href=" . $fileUrl . "><button>Download release</button></a> </p>";
				        	}
				        	else if ($extension['extension'] == "mp3" || $extension['extension'] == "wav")
				        	{
				        		$player = "<audio controls> <source src=" . $fileUrl . " type=audio/"  . $extension['extension'] . "></audio>";
				           		echo "<tr> <td>" . $entry . "</td> <td>" . $player . "</td>" . "</td></tr>";
				       		}

				        }
		    		}	
		    		
		    		closedir($handle);
				}
			}
			else
			{}
			echo "</table></center>";
		}
		mysql_close($con);
		?>

	</body>
</html>