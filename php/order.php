<?php
			$releaseCAT = htmlspecialchars($_GET["cat"]);
			$address = htmlspecialchars($_GET["address"]);
			$name = htmlspecialchars($_GET["name"]);
			$email = htmlspecialchars($_GET["email"]);
			$zone = htmlspecialchars($_GET["zone"]);
			$price = htmlspecialchars($_GET["price"]);
			if ($zone == 'UK') $price += 3.5;
			else if ($zone == 'EU') $price += 5;
			else if ($zone == 'RW') $price += 9;

			$pwd = file_get_contents('../../pwd', true);
			$usr = file_get_contents('../../usr', true);
			$pwd=preg_replace('/\s+/', '', $pwd);
			$usr=preg_replace('/\s+/', '', $usr);
			$con=mysqli_connect("localhost",$usr, $pwd, "Sales");
			if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

			mysqli_query($con, "INSERT INTO Orders (Address, Amount, CatalogueNumber, Email, Name, Status, Zone)
								VALUES ('$address', '$price', '$releaseCAT', '$email', '$name', 'new', '$zone')");
			$paypalURL = "https://www.paypal.com/cgi-bin/webscr?&cmd=_xclick&currency_code=GBP&business=contact@nummermusic.com&amount=" . $price . "&item_name=" . $releaseCAT;
			mysql_close($con);

			$con=mysqli_connect("localhost",$usr,$pwd, "Releases");
			if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

			$result = mysqli_query($con,"SELECT * FROM Releases WHERE CatalogueNumber = '$releaseCAT'");
			$row = mysqli_fetch_array($result);

			$newInventory = $row['Inventory'] - 1;
			mysqli_query($con,"UPDATE Releases SET Inventory='$newInventory' WHERE CatalogueNumber='$releaseCAT'");
			mysql_close($con);

			header( "Location:" . $paypalURL ) ;
?>
