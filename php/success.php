<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="icon" type="image/jpg" href="images/favicon14px.jpg">
		<title>NUMMER MUSIC</title>
	</head>
	<script src="js/scripts.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<body>
		<?php
			$releaseCAT = htmlspecialchars($_GET["cat"]);
			$pwd = file_get_contents('../../pwd', true);
			$usr = file_get_contents('../../usr', true);
			$pwd=preg_replace('/\s+/', '', $pwd);
			$usr=preg_replace('/\s+/', '', $usr);		
			$con=mysqli_connect("localhost",$usr, $pwd, "NummerWebsite");
			if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();
			

			$token = htmlspecialchars($_GET["token"]);
			$PayerID = htmlspecialchars($_GET["PayerID"]);

			$paypalResponse = file_get_contents('https://api-3t.paypal.com/nvp?TOKEN=' . $token . '&VERSION=106.0&SIGNATURE=AXYVGbf-S.vpK0cdOArIz.pHtQkyAL2coxQtEK20Oi-L1p4KnSsIwULe&METHOD=GetExpressCheckoutDetails&PWD=HKTYCLKWULYA6LP3&USER=contact_api1.nummermusic.com');
			parse_str($paypalResponse);

			$name = $FIRSTNAME  . ' ' . $LASTNAME;
			$address = $SHIPTONAME . " " . $SHIPTOSTREET . " " . $SHIPTOZIP . " " . $SHIPTOCITY . " " . $SHIPTOCOUNTRYNAME;

			mysqli_query($con, "INSERT INTO Orders (Address, Amount, CatalogueNumber, Email, Name, Status, Zone)
								VALUES ('$address', '$AMT', '$releaseCAT', '$EMAIL', '$name', '$ACK', '$SHIPTOCOUNTRYCODE')");
			mysql_close($con);

			$to      = $EMAIL;
			$subject = 'Thanks for your order' . ' - ' . $releaseCAT;
			$message = "Thanks for your order, we will give you a heads up when it's on its way :)" . "\r\n" . "Cheers" . "\r\n" . "Nummer";
			$headers = 'From: Nummer Music <contact@nummermusic.com>' . "\r\n" .
			    'Reply-To: contact@nummermusic.com' . "\r\n" .
			    'X-Mailer: PHP/' . phpversion();
			mail($to, $subject, $message, $headers);
		?>

		<center> <H2>Thanks for your order. We will get in touch with you very soon</H2>

			<H3>Redirecting to Nummer Music...</H3></center>
			<script type="text/javascript">
			setTimeout("location.href = 'http://www.nummermusic.com';",2500);
			</script>
	</body>
</html>





