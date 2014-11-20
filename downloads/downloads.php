<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="../style.css">
		<link rel="icon" type="image/jpg" href="/images/favicon14px.jpg">
		<title>Downloads</title>
		<script>
			function incDLCount(credit)
			{
				var xmlhttp;
				if (credit=="")
				{
					document.getElementById("txtHint").innerHTML="";
					return;
				}
				if (window.XMLHttpRequest) // code for IE7+, Firefox, Chrome, Opera, Safari
				{
					xmlhttp=new XMLHttpRequest();
				}
				else // code for IE6, IE5
				{
				  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange=function()
				{
					if (xmlhttp.readyState==4 && xmlhttp.status==200)
				    {}
				}
				xmlhttp.open("GET","../php/incDLCount.php?credit="+credit,true);
				xmlhttp.send();
			}
		</script>
	</head>
	<script src="/js/scripts.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<body>
		<center>
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
			$zip;
			if ($credit != "ALL")
			{
				$dir = "../audio/" . $credit;
				echo "<img id='flyer' style='height:auto; width:auto; max-width:300px; max-height:400px;' src=" . $dir . "/artwork.jpg" . ">";
				echo "<table id='songArray' border='1'";   		
				if ($handle = opendir($dir)) 
				{	
		   			while (false !== ($entry = readdir($handle))) 
		   			{
		       			if ($entry != "." && $entry != ".." && $entry != ".DS_Store") 
				        {
				        	$fileUrl = $dir . "/" . $entry ;
				        	$fileUrl = str_replace(' ', '%20', $fileUrl);
				        	$extension = pathinfo($fileUrl);
				        	if ($extension['extension'] == "mp3" || $extension['extension'] == "wav")
				        	{
				        		$player = "<audio controls> <source src=" . $fileUrl . " type=audio/"  . $extension['extension'] . "></audio>";
				           		echo "<tr> <td>" . $entry . "</td> <td>" . $player . "</td>" . "</tr>";
				       		}
				       		else if($extension['extension'] == "zip")
				       		{
				       			$zip = $fileUrl;
				       		}
				        }
		    		}	
		    	closedir($handle);
				}			        	
			}
			echo "</table>";
			echo '<p><a id="downloadButton" href="' . $zip . '" onclick="incDLCount(\''.$credit.'\')"> Download release </a> </p>';
		}
		mysql_close($con);
		?>
	</center>
	</body>
</html>