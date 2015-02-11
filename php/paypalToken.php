<?php
			$releaseCAT = htmlspecialchars($_GET["cat"]);
			$price = htmlspecialchars($_GET["price"]);

			if ($zone == 'UK') $price += 3.75;
			else if ($zone == 'EU') $price += 5.50;
			else if ($zone == 'RW') $price += 9;


			$paypalResponse = file_get_contents('https://api-3t.paypal.com/nvp?USER=contact_api1.nummermusic.com&PWD=HKTYCLKWULYA6LP3&SIGNATURE=AXYVGbf-S.vpK0cdOArIz.pHtQkyAL2coxQtEK20Oi-L1p4KnSsIwULe&METHOD=SetExpressCheckout&VERSION=78&PAYMENTREQUEST_0_PAYMENTACTION=SALE&PAYMENTREQUEST_0_AMT=' . $price . '&PAYMENTREQUEST_0_CURRENCYCODE=GBP&cancelUrl=http://www.nummermusic.com/php/cancel.php?cat=' . $releaseCAT . '&returnUrl=http://www.nummermusic.com/php/success.php?cat='. $releaseCAT);

			parse_str($paypalResponse);

			$paypalURL = "https://www.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=" . $TOKEN;
			echo $paypalURL;
?>
