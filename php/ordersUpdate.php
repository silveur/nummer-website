<?php 
	
	$pwd = file_get_contents('../../pwd', true);
	$usr = file_get_contents('../../usr', true);
	$usr=preg_replace('/\s+/', '', $usr);
	$pwd=preg_replace('/\s+/', '', $pwd);
	
	$con=mysqli_connect("localhost",$usr, $pwd, "NummerWebsite");
	if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

	$formAction = $_POST[formAction];
	$name=$_POST[name];
	$email = $_POST[email];
	$address = $_POST[address];
	$country = $_POST[country];
	$item = $_POST[item];
	$status = $_POST[status];
	$price = $_POST[price];
	$note = $_POST[note];
	
	if ($formAction == "add")
	{
		mysqli_query($con, "INSERT INTO Orders (Address, Amount, CatalogueNumber, Email, Name, Status, Zone)
								VALUES ('$address', '$price', '$item', '$email', '$name', '$status', '$country')");
	}

	else if ($formAction == "remove")
	{
		$return = mysqli_query($con, "DELETE FROM Orders WHERE Name='$name' AND CatalogueNumber='$item'");
	}

	else if ($formAction == "update")
	{
		$return = mysqli_query($con, "UPDATE Orders SET Note='$note' WHERE Name='$name' AND CatalogueNumber='$item'");
	}

	header( "Location:http://localhost:8888/orders.php") ;
?>