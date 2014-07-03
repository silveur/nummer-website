<?php

$UserName = htmlspecialchars($_GET["UserName"]);
$OSVersion = htmlspecialchars($_GET["OSVersion"]);
$StepsVersion = htmlspecialchars($_GET["StepsVersion"]);
$Location = htmlspecialchars($_GET["Location"]);



	// echo 'OSVersion: ' . $OSVersion . "\n";
	// echo 'StepsVersion: ' . $StepsVersion . "\n";
	// echo 'UserName: ' . $UserName . "\n";
	// echo 'Location: ' . $Location . "\n";

$con=mysqli_connect("localhost","root","root", "StepsTracker");
if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

// $sql="CREATE TABLE UserInfos(UserName CHAR(30),OSVersion CHAR(30),StepsVersion CHAR(30),Location CHAR(2),NumConnexion INT)";
// // Execute query
// if (mysqli_query($con,$sql)) {
//   echo "Table created successfully";
// } else {
//   echo "Error creating table: " . mysqli_error($con);
// }

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
	echo "Thanks for the infos." . "\n";
}

mysql_close($con);


?>