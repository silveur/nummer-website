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
	<style type="text/css">
	body , h2
	{
		color: white;
    	background-color: black;
	}
	a
	{
		color: white;
		text-decoration: underline;
	}
	</style>
	<body>
		<?php
			$releaseCAT = htmlspecialchars($_GET["cat"]);
			$paypalPWD = file_get_contents('../../paypalPWD', true);
			$paypalPWD=preg_replace('/\s+/', '', $paypalPWD);
			$pwd = file_get_contents('../../pwd', true);
			$usr = file_get_contents('../../usr', true);
			$pwd=preg_replace('/\s+/', '', $pwd);
			$usr=preg_replace('/\s+/', '', $usr);		
			$con=mysqli_connect("localhost",$usr, $pwd, "NummerWebsite");
			if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
			

			$token = htmlspecialchars($_GET["token"]);
			$PayerID = htmlspecialchars($_GET["PayerID"]);

			$paypalResponse = file_get_contents('https://api-3t.paypal.com/nvp?TOKEN=' . $token . '&VERSION=106.0&SIGNATURE=AXYVGbf-S.vpK0cdOArIz.pHtQkyAL2coxQtEK20Oi-L1p4KnSsIwULe&METHOD=GetExpressCheckoutDetails&PWD=' . $paypalPWD . '&USER=contact_api1.nummermusic.com');
			parse_str($paypalResponse);

			$name = $FIRSTNAME  . ' ' . $LASTNAME;
			$address = $SHIPTONAME . " " . $SHIPTOSTREET . " " . $SHIPTOZIP . " " . $SHIPTOCITY . " " . $SHIPTOCOUNTRYNAME;
			$address = addslashes($address);
			$name = addslashes($name);
			mysqli_query($con, "INSERT INTO Orders (Address, Amount, CatalogueNumber, Email, Name, Status, Zone, Token)
								VALUES ('$address', '$AMT', '$releaseCAT', '$EMAIL', '$name', '$ACK', '$SHIPTOCOUNTRYCODE', '$token')");

			$result = mysqli_query($con,"SELECT * FROM Releases WHERE CatalogueNumber = '$releaseCAT'");
			$row = mysqli_fetch_array($result);
			$newInventory = $row['Inventory'] - 1;
			mysqli_query($con,"UPDATE Releases SET Inventory='$newInventory' WHERE CatalogueNumber='$releaseCAT'");

			$confirmation = file_get_contents('https://api-3t.paypal.com/nvp?TOKEN=' . $token . '&PAYMENTREQUEST_0_AMT=' .$AMT . '&PayerID=' . $PayerID. '&VERSION=106.0&&PAYMENTREQUEST_0_PAYMENTACTION=SALE&SIGNATURE=AXYVGbf-S.vpK0cdOArIz.pHtQkyAL2coxQtEK20Oi-L1p4KnSsIwULe&METHOD=DoExpressCheckoutPayment&PWD=HKTYCLKWULYA6LP3&USER=contact_api1.nummermusic.com&PAYMENTREQUEST_0_CURRENCYCODE=GBP');
			parse_str($confirmation);

			if ($ACK=='Success')
			{
				echo "<center> <H2>Thanks for your order. We will get in touch with you very soon</H2>";
				mysql_close($con);

				$to      = $EMAIL;
				$subject = 'Thanks for your order' . ' - ' . $releaseCAT;
				$message = "Thanks for your order, we will give you a heads up when it's on its way :)" . "\r\n" . "Cheers" . "\r\n" . "Nummer";
				$headers = 'From: Nummer Music <contact@nummermusic.com>' . "\r\n" .
				    'Reply-To: contact@nummermusic.com' . "\r\n" .
				    'X-Mailer: PHP/' . phpversion();
				mail($to, $subject, $message, $headers);
			}
			else
			{
				echo "<center> <H2>An error has occured. Sorry for the inconvenience</H2>";
				$to      = 'contact@nummermusic.com';
				$subject = 'ORDER CANCELLED' . ' - ' . $releaseCAT;
				$message = $confirmation;
				$headers = 'From: Nummer Music <no-reply@nummermusic.com>' . "\r\n" .
				    'Reply-To: contact@nummermusic.com' . "\r\n" .
				    'X-Mailer: PHP/' . phpversion();
				mail($to, $subject, $message, $headers);
			}
			echo '<a href="http://www.nummermusic.com">Back to Nummer Music</a>';
		?>
	</body>
</html>





