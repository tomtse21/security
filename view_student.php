<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View student</title>
</head>

<body>
<table width="400" border="1">
<tr>
    <td width="90">Student id</td>
    <td width="218">Student Name</td>
    <td width="70">Age</td>
  </tr>
<?php

/* conect to database */
require("connect_db.php");

/* execute sql */

$sql = "SELECT * FROM student";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result))
{
    echo "<tr>";
    echo  "<td>$row[stu_id]</td>";
    echo  "<td>$row[stu_name]</td>";
    echo  "<td>$row[age]</td>";
    echo "</tr>";
}
?>
</table>
<p><a href="index.php">Go back to index page</a></p>
</body>
</html>