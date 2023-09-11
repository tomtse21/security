<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Student Success!</title>
</head>

<body>
<?php

/* conect to database */
require("connect_db.php");

/* Get form data */

$stu_name = $_POST["name"];
$age = $_POST["age"];

/* execute sql */

$insert_sql = "INSERT INTO student (stu_name, age) VALUES ('$stu_name', $age)";
mysqli_query($conn, $insert_sql);

?>
<p>Add student success!</p>
<p><a href="index.php">Go back to index page</a></p>
</body>
</html>