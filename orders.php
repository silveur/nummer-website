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
		$totalAmount = 0;
		while($row = mysqli_fetch_array($result))
		{
			$totalAmount += $row["Amount"];
		}
		$numRows = mysqli_num_rows($result);
		echo "<H2>Orders</H2>";
		echo "<H3>Total: $numRows - £$totalAmount </H3>"; 
		echo "<div><table border='1'>";
		
		$result = mysqli_query($con,"SELECT * FROM Orders");
		while($row = mysqli_fetch_array($result))
		{
			echo $row['name'];
			?>
				<tr>
					<td><?php echo $row["Name"] ?></td>
					<td><?php echo $row["Email"] ?></td>
					<td><?php echo $row["Address"] ?></td>
					<td><?php echo $row["Zone"] ?></td>
					<td><?php echo $row["CatalogueNumber"] ?></td>
					<td><?php echo $row["Status"] ?></td>
					<td><?php echo $row["Amount"] ?></td>
					<td>
					<form action="php/ordersUpdate.php" method="POST">
						<input height="48" id="note" type="text" name="note" value="<?php echo $row["Note"] ?>">
						<input id="name" type="hidden" name="name" value="<?php echo $row["Name"] ?>">
						<input id="item" type="hidden" name="item" value="<?php echo $row["CatalogueNumber"] ?>">
						<input type="hidden" name="formAction" value="update">
						<input type="submit" value="Update note">
					</form></td>

					<td> <form onsubmit="return confirm('Fais pas le con mec!');" action="php/ordersUpdate.php" method="POST">
						<input id="name" type="hidden" name="name" value="<?php echo $row["Name"] ?>">
						<input id="item" type="hidden" name="item" value="<?php echo $row["CatalogueNumber"] ?>">
						<input type="hidden" name="formAction" value="remove">
						<input type="submit" value="Delete">
					</form></td>
				</tr>
				<?php
		}
			
		echo "</table></div>";

			?>
			<div><br>
			<form action="php/ordersUpdate.php" method="POST">
				<input id="name" type="text" name="name" value="Name"><br>
				<input id="email" type="text" name="email" value="Email"><br>
				<input id="address" type="text" name="address" value="Address"><br>
				<input id="country" type="text" name="country" value="Country"><br>
				<input id="item" type="text" name="item" value="NUMM01"><br>
				<input id="status" type="text" name="status" value="Paid"><br>
				<input id="price" type="text" name="price" value="price"><br>
				<input id="note" type="text" name="note" value="Note"><br>
				<input type="hidden" name="formAction" value="add">
				<input type="submit" value="Add to Record">
			</form>
			
		</div>
    	<?php
		mysql_close($con);

			?>	
			</center>
	</body>
</html>
