<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="/css/style.css">
		<link rel="icon" type="image/jpg" href="images/favicon14px.jpg">
		<title>NUMMER MUSIC</title>
	</head>
	<script src="js/scripts.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<body>
		<center>
		<?php

		$pwd = file_get_contents('../pwd', true);
		$usr = file_get_contents('../usr', true);
		$usr=preg_replace('/\s+/', '', $usr);
		$pwd=preg_replace('/\s+/', '', $pwd);
		
		$con=mysqli_connect("localhost",$usr, $pwd, "NummerWebsite");
		if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

		$result = mysqli_query($con,"SELECT * FROM Orders");
		echo "<H2>Orders</H2>";
		echo "<table border='1'>
		<tr>
		
		</tr>";

		while($row = mysqli_fetch_array($result))
		{
		  echo "<tr>";
		  echo "<td>" . $row['Name'] . "</td>";
		  echo "<td>" . $row['Email'] . "</td>";
		  echo "<td>" . $row['Address'] . "</td>";
		  echo "<td>" . $row['Zone'] . "</td>";
		  echo "<td>" . $row['CatalogueNumber'] . "</td>";
		  echo "<td>" . $row['Status'] . "</td>";
		  echo "<td>" . $row['Amount'] . "</td>";
		  echo "<td style='width:30%'><div contenteditable>" . 'Note' . "</div></td>";
		  echo "</tr>";
		}
		mysql_close($con);
		echo "</table>";

				?>	
			</center>
	</body>
</html>
