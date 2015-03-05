<?php require( $_SERVER['DOCUMENT_ROOT'] . "/php/app.php") ?>
<!DOCTYPE html>
<html>
	<body bgcolor="lightgrey">
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

		$result = mysqli_query($con,"SELECT * FROM Releases");
		echo '<H2>Inventory</H2><table border=1>';
		?> 
			<tr>
				<td>Release</td>
				<td>Stock</td>
			</tr>
		<?php
		while($row = $result->fetch_assoc())
		{
			?>
				<tr>
					<td><?php echo $row["CatalogueNumber"] ?></td>
					<td>
					<form action="ordersUpdate.php" method="POST">
						<input contenteditable="true" type="text" name="inventory" value="<?php echo $row["Inventory"] ?>">
						<input type="hidden" name="catNumber" value="<?php echo $row["CatalogueNumber"] ?>">
						<input type="hidden" name="formAction" value="updateInventory">
						<input type="submit" value="Update">
					</form></td>
				</tr>
			<?php
		}
		echo '</table>';


		$result = mysqli_query($con,"SELECT * FROM Orders");

		$NUMM01Count = 0;
		$PBR004Count = 0;
		$NJ01Count = 0;
		$totalAmount = 0;
		while($row = mysqli_fetch_array($result))
		{
			$totalAmount += $row["Amount"];
			if($row["CatalogueNumber"] == "NUMM01")
				$NUMM01Count += 1;
			else if($row["CatalogueNumber"] == "PBR004")
				$PBR004Count += 1;
			else if($row["CatalogueNumber"] == "NJ01")
				$NJ01Count += 1;
		}
		$numRows = mysqli_num_rows($result);
		echo "<H2>Orders</H2>";
		echo "<H3>Total: $numRows - £$totalAmount - " . "NUMM01:$NUMM01Count - " . "NJ01:$NJ01Count - " . " PBR004:$PBR004Count </H3>"; 
		echo "<div><table border='1'>";
		
		$result = mysqli_query($con, "SELECT * FROM Orders");
		while($row = $result->fetch_assoc())
		{
			?>
				<tr>
					<td><?php echo '#' . $row["ID"] ?></td>
					<td><?php echo $row["Name"] ?></td>
					<td><?php echo $row["Email"] ?></td>
					<td><?php echo $row["Address"] ?></td>
					<td><?php echo $row["Zone"] ?></td>
					<td><?php echo $row["CatalogueNumber"] ?></td>
					<td><?php echo $row["Status"] ?></td>
					<td><?php echo $row["Amount"] ?></td>
					<td><?php echo $row["Quantity"] ?></td>
					<td><?php echo $row["Note"] ?></td>
					<td>
					<form action="ordersUpdate.php" method="POST">
						<input id="ID" type="hidden" name="ID" value="<?php echo $row["ID"] ?>">
						<input type="hidden" name="formAction" value="update">
						<input type="submit" value="Update">
					</form></td>
				</tr>
			<?php
		}
			
		echo "</table></div>";

			?>
			<div><br>
			<form action="ordersUpdate.php" method="POST">
				<input type="text" name="name" value="Name"><br>
				<input type="text" name="email" value="Email"><br>
				<input type="text" name="address" value="Address"><br>
				<input type="text" name="country" value="Country"><br>
				<input type="text" name="catNumber" value="NUMM01"><br>
				<input type="text" name="status" value="Paid"><br>
				<input type="text" name="price" value="price"><br>
				<input type="text" name="quantity" value="quantity"><br>
				<input type="text" name="note" value="note"><br>
				<input type="hidden" name="formAction" value="add">
				<input type="submit" value="Add to Record">
			</form></div><br>
    		<?php

			?>	
			</center>
	</body>
</html>
