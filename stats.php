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
		<?php

		$pwd = file_get_contents('../pwd', true);
		$usr = file_get_contents('../usr', true);
		$usr=preg_replace('/\s+/', '', $usr);
		$pwd=preg_replace('/\s+/', '', $pwd);
		
		$con=mysqli_connect("localhost",$usr, $pwd, "StepsTracker");
		if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

		$result = mysqli_query($con,"SELECT * FROM UserInfos");
		echo "<center><H2> Steps statistics</H2>";
		echo "<table border='1'>
		<tr>
		<th>UserName </th>
		<th>Operating System</th>
		<th>Software Version</th>
		<th>Location </th>
		<th>Total Usage </th>

		</tr>";

		while($row = mysqli_fetch_array($result))
		{
		  echo "<tr>";
		  echo "<td>" . $row['UserName'] . "</td>";
		  echo "<td>" . $row['OSVersion'] . "</td>";
		  echo "<td>" . $row['StepsVersion'] . "</td>";
		  echo "<td>" . $row['Location'] . "</td>";
		  echo "<td>" . $row['NumConnexion'] . "</td>";

		  echo "</tr>";
		}
		echo "</table>";
		mysql_close($con);
		?>	
		
		<?php

		$con=mysqli_connect("localhost",$usr, $pwd, "NummerWebsite");
		if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

		$result = mysqli_query($con,"SELECT * FROM Voucher");
		echo "<H2>Downloads statistics</H2>";
		echo "<table border='1'>
		<tr>
		<th>Release </th>
		<th>Downloads</th>

		</tr>";

		while($row = mysqli_fetch_array($result))
		{
		  echo "<tr>";
		  echo "<td>" . $row['Code'] . "</td>";
		  echo "<td>" . $row['DownloadCounter'] . "</td>";
		  echo "</tr>";
		}
		mysql_close($con);
		echo "</table>";
		?>	
	</body>
</html>
