<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<!-- <link rel="stylesheet" type="text/css" href="/css/style.css"> -->
		<link rel="icon" type="image/jpg" href="images/favicon14px.jpg">
		<title>NUMMER MUSIC</title>
	</head>
	<script src="js/scripts.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<body>
		<?php
			$releaseCAT = htmlspecialchars($_GET["cat"]);

			$con=mysqli_connect("localhost","root","root", "Releases");
			if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

			$result = mysqli_query($con,"SELECT * FROM Releases WHERE CatalogueNumber = '$releaseCAT'");
			$row = mysqli_fetch_array($result);

			$newInventory = $row['Inventory'] - 1;
			mysqli_query($con,"UPDATE Releases SET Inventory='$newInventory' WHERE CatalogueNumber='$releaseCAT'");
			
			mysql_close($con);
		?>

		<p> Thanks for your order. We will get in touch with you very soon</p>

	</body>
</html>
