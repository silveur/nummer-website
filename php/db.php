<?php
	$credits = file_get_contents('../credits.json', true);
	$obj = json_decode($credits);
	
	$pwd = $obj->{'pwd'};
	$usr = $obj->{'usr'};

	$con=mysqli_connect("localhost",$usr, $pwd, "NummerWebsite");
?>