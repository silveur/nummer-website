<?php

$UserName = htmlspecialchars($_GET["UserName"]);
$OSVersion = htmlspecialchars($_GET["OSVersion"]);
$StepsVersion = htmlspecialchars($_GET["StepsVersion"]);
$Location = htmlspecialchars($_GET["Location"]);

$pwd = file_get_contents('../pwd', true);
$usr = file_get_contents('../usr', true);
$usr=preg_replace('/\s+/', '', $usr);
$pwd=preg_replace('/\s+/', '', $pwd);

$con=mysqli_connect("localhost", $usr, $pwd, "StepsTracker");
if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

$result = mysqli_query($con,"SELECT * FROM UserInfos
WHERE UserName='$UserName'");

if(mysqli_num_rows($result) == 0) 
{
	mysqli_query($con, "INSERT INTO UserInfos (UserName, OSVersion, StepsVersion, Location, NumConnexion)
		VALUES ('$UserName', '$OSVersion', '$StepsVersion', '$Location', 1)");
	echo 'Added an entry.';
} 
else 
{
	$row = mysqli_fetch_array($result);
	$currentConnexion = $row['NumConnexion'] + 1;
	mysqli_query($con,"UPDATE UserInfos SET NumConnexion='$currentConnexion'
	WHERE UserName='$UserName'");
	mysqli_query($con,"UPDATE UserInfos SET StepsVersion='$StepsVersion'
	WHERE UserName='$UserName'");
	echo "Thanks for the infos." . "\n";
}

mysql_close($con);

?>