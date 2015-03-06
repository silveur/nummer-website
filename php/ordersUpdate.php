<?php require( $_SERVER['DOCUMENT_ROOT'] . "/php/app.php") ?>
<?php 
	
	$formAction = $_POST[formAction];
	$name=$_POST[name];
	$email = $_POST[email];
	$address = $_POST[address];
	$country = $_POST[country];
	$catNumber = $_POST[catNumber];
	$status = $_POST[status];
	$price = $_POST[price];
	$quantity = $_POST[quantity];
	$note = $_POST[note];
	$ID = $_POST[ID];
	$inventory = $_POST[inventory];

	if ($formAction == "submit")
	{
		$queryVar = "UPDATE Orders SET Name='$name', Email='$email', Address='$address', Zone='$country', CatalogueNumber='$catNumber', Status='$status', Amount='$price', Quantity='$quantity', Note='$note' WHERE ID='$ID'";
		mysqli_query($con, $queryVar);
		header('Location:orders.php');
	}
	else if ($formAction == "delete")
	{
		$queryVar = "DELETE FROM Orders WHERE ID='$ID' ";
		mysqli_query($con, $queryVar);
		header('Location:orders.php');
	}
	else if ($formAction == "updateInventory")
	{
		$queryVar = "UPDATE Releases SET Inventory='$inventory' WHERE CatalogueNumber='$catNumber' ";
		mysqli_query($con, $queryVar);
		header('Location:orders.php');
	}
	else if ($formAction == "email")
	{
		$queryVar = "UPDATE Orders SET Status='Shipped' WHERE ID='$ID'";
		mysqli_query($con, $queryVar);

		$result = mysqli_query($con, "SELECT * FROM Orders WHERE ID = $ID");
		$row = $result->fetch_assoc();

		$subject = $row['CatalogueNumber'] . ' - Shipping confirmation';
		$message = "Hey your order has been dispatched." . "\r\n" . "Cheers" . "\r\n" . "Nummer";
		$headers = 'From: Nummer Music <contact@nummermusic.com>' . "\r\n" .
		    'Reply-To: contact@nummermusic.com' . "\r\n" .
		    'X-Mailer: PHP/' . phpversion();
		mail($row['Email'], $subject, $message, $headers);
		header('Location:orders.php');
	}
	else if ($formAction == "add")
	{
		$result = mysqli_query($con, 'SELECT ID FROM Orders ORDER BY ID DESC LIMIT 1;');
		if (mysqli_num_rows($result) > 0)
		{
			$ID = mysqli_fetch_row($result);
			$newID = $ID[0] + 1;
			$address = addslashes($address);
			mysqli_query($con, "INSERT INTO Orders (Address, Amount, CatalogueNumber, Email, Name, Status, Zone, Quantity, ID, Note)
								VALUES ('$address', '$price', '$item', '$email', '$name', '$status', '$country', '$quantity', '$newID', '$note')");
			header('Location:orders.php');
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
  <title>Page Title</title>
</head>

<body>

 	<?php $result = mysqli_query($con, "SELECT * FROM Orders WHERE ID = $ID");
	$row = $result->fetch_assoc();
	?>
		<center><div><br>
		<form action="ordersUpdate.php" method="POST">
			<br>Name:<br>
			<input autocomplete="off" class="updateForm" align="centered" type="text" name="name" value="<?php echo $row['Name']; ?>"><br>
			<br>Email:<br>
			<input autocomplete="off" class="updateForm" type="text" name="email" value="<?php echo $row['Email']; ?>"><br>
			<br>Address:<br>
			<input autocomplete="off" class="updateForm highForm" type="text" name="address" value="<?php echo $row['Address']; ?>"><br>
			<br>Country code:<br>
			<input autocomplete="off" class="updateForm" type="text" name="country" value="<?php echo $row['Zone']; ?>"><br>
			<br>Catalogue number:<br>
			<input class="updateForm" type="text" name="catNumber" value="<?php echo $row['CatalogueNumber']; ?>"><br>
			<br>Order status:<br>
			<input autocomplete="off" class="updateForm" type="text" name="status" value="<?php echo $row['Status']; ?>"><br>
			<br>Order amount:<br>
			<input class="updateForm" type="text" name="price" value="<?php echo $row['Amount']; ?>"><br>
			<br>Quantity:<br>
			<input class="updateForm" type="text" name="quantity" value="<?php echo $row['Quantity']; ?>"><br>
			<br>Note:<br>
			<input class="updateForm" name="note" value="<?php echo $row['Note']; ?>"><br>
			<input type="hidden" name="formAction" value="submit">
			<input type="hidden" name="ID" value="<?php echo $row['ID']; ?>"><br>
			<input type="submit" value="Submit changes">
		</form></div>
		<div><br>
		<form onsubmit="return confirm('Fais pas le con mec!');" action="ordersUpdate.php" method="POST">
			<input type="hidden" name="formAction" value="delete">
			<input type="hidden" name="ID" value="<?php echo $row['ID']; ?>">
			<input type="submit" value="Delete entry">
		</form></div>

		</div></center>
	<?php
	?>

</body>

</html>