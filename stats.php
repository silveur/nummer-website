<?php

$con=mysqli_connect("localhost","root","root", "StepsTracker");
if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

$result = mysqli_query($con,"SELECT * FROM UserInfos");

echo "<table border='1'>
<tr>
<th>UserName </th>
<th>Operating System</th>
<th>Software Version</th>
<th>Location </th>
<th>Total Usage </th>

</tr>";

while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['UserName'] . "</td>";
  echo "<td>" . $row['OSVersion'] . "</td>";
  echo "<td>" . $row['StepsVersion'] . "</td>";
  echo "<td>" . $row['Location'] . "</td>";
  echo "<td>" . $row['NumConnexion'] . "</td>";

  echo "</tr>";
}

?>	