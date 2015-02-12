<?php
			$releaseCAT = htmlspecialchars($_GET["cat"]);
			$price = htmlspecialchars($_GET["price"]);
			$zone = htmlspecialchars($_GET["zone"]);
			if ($zone == 'UK') $price += 3.75;
			else if ($zone == 'EU') $price += 5.50;
			else if ($zone == 'RW') $price += 9;

			$paypalPWD = file_get_contents('../../paypalPWD', true);
			$paypalPWD=preg_replace('/\s+/', '', $paypalPWD);

			$paypalResponse = file_get_contents('https://api-3t.paypal.com/nvp?USER=contact_api1.nummermusic.com&PWD='. $paypalPWD . '&SIGNATURE=AXYVGbf-S.vpK0cdOArIz.pHtQkyAL2coxQtEK20Oi-L1p4KnSsIwULe&METHOD=SetExpressCheckout&VERSION=78&PAYMENTREQUEST_0_PAYMENTACTION=SALE&PAYMENTREQUEST_0_AMT=' . $price . '&PAYMENTREQUEST_0_CURRENCYCODE=GBP&cancelUrl=http://www.nummermusic.com/php/cancel.php?cat=' . $releaseCAT . '&returnUrl=http://www.nummermusic.com/php/success.php?cat='. $releaseCAT . '&PAYMENTREQUEST_0_SHIPPINGAMT=' . $price . '&L_PAYMENTREQUEST_0_NAMEm=' . $releaseCAT);

			parse_str($paypalResponse);

			$paypalURL = "https://www.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=" . $TOKEN;
			header( "Location:" . $paypalURL ) ;
?>
