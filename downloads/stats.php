<?php

$con=mysqli_connect("localhost","root","root", "AudioDownloads");
if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

$result = mysqli_query($con,"SELECT * FROM Voucher");

echo "<table border='1'>
<tr>
<th>Release </th>
<th>Downloads</th>

</tr>";

while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['Credit'] . "</td>";
  echo "<td>" . $row['DownloadCounter'] . "</td>";


  echo "</tr>";
}

mysql_close($con);
?>	