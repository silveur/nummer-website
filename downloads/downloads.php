<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="/css/downloads.css">
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

		$pwd = file_get_contents('../../pwd', true);
		$usr = file_get_contents('../../usr', true);
		$usr=preg_replace('/\s+/', '', $usr);
		$pwd=preg_replace('/\s+/', '', $pwd);
		$con=mysqli_connect("localhost",$usr, $pwd, "NummerWebsite");
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
				$phpdir = "../releases/" . $credit . "/audio";
				$htmldir = "/releases/" . $credit;
				echo "<img id='flyer' style='height:auto; width:auto; max-width:300px; max-height:400px;' src=" . $htmldir . "/Artworks/" .$credit . ".png>";
				echo "<table id='songArray' border='1'";   		
				if ($handle = opendir($phpdir)) 
				{	
					$array = array();
		   			while (false !== ($entry = readdir($handle))) 
		   			{
		       			if ($entry != "." && $entry != ".." && $entry != ".DS_Store") 
				        {
				        	$fileUrl = $htmldir . "/Audio/" . $entry ;
				        	$fileUrl = str_replace(' ', '%20', $fileUrl);
				        	$extension = pathinfo($fileUrl);
				        	if ($extension['extension'] == "mp3" || $extension['extension'] == "wav")
				        	{
				        		$player = "<audio controls> <source src=" . $fileUrl . " type=audio/"  . $extension['extension'] . "></audio>";
				           		$str = "<tr> <td>" . $entry . "</td> <td>" . $player . "</td>" . "</tr>";
				           		array_push($array, $str);
				       		}
				       		else if($extension['extension'] == "zip")
				       		{
				       			$zip = $fileUrl;
				       		}
				        }
		    		}
		    		sort($array, SORT_NATURAL | SORT_FLAG_CASE);
		    		foreach ($array as $key => $val)
		    		{
	   					echo $val;
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