<?php

		$Credit = htmlspecialchars($_GET["credit"]);
		$pwd = file_get_contents('../../pwd', true);
		$usr = file_get_contents('../../usr', true);
		$con=mysqli_connect("localhost",$usr, $pwd, "AudioDownloads");
		if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

		$result = mysqli_query($con,"SELECT * FROM Voucher WHERE Credit='$Credit'");

		$row = mysqli_fetch_array($result);
		$numOfCon = $row['DownloadCounter'] + 1;
		mysqli_query($con,"UPDATE Voucher SET DownloadCounter='$numOfCon' WHERE Credit='$Credit'");
		mysql_close($con);
?>

