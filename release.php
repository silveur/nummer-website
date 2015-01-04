<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="css/release.css">
		<link rel="icon" type="image/jpg" href="images/favicon14px.jpg">
		<title>NUMMER MUSIC</title>
	</head>
	<script src="js/scripts.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<body>
		
		<?php
			$releaseCAT = htmlspecialchars($_GET["release"]);

			$con=mysqli_connect("localhost","root","root", "Releases");
			if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

			$result = mysqli_query($con,"SELECT * FROM Releases WHERE CatalogueNumber = '$releaseCAT'");
			$row = mysqli_fetch_array($result);

			echo $row['VideoLink'] ;
			echo "</br>Release name: " . $row['ReleaseName'];
			echo "</br>Record label: " . $row['RecordLabel'];
			echo "</br>Catalogue number: " . $row['CatalogueNumber'];
			echo "</br>Inventory: " . $row['Inventory'];
			if($row['Inventory'] == 0) echo "</br>Sold out";
			else
			{
				?>
     				<form action="action_page.php">
					First and last name:<br>
					<input type="text" name="firstname" value="First Name">
					<br>
					
					<input type="submit" value="Submit">
					</form>
				<?php 

			}
			mysql_close($con);
		?>

		<p> For grouped orders please contact us by email: contact@nummermusic.com </p>
	</body>
</html>
