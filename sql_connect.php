<html>
<head>
<title>SQL Injection Demo</title>
</head>
<body>
<?php
$conn = mysqli_connect("localhost","root","", "test");

$id = $_POST["id"]; // get user input which name is "id"
$pwd = $_POST["pwd"]; // get user input which name is "pwd"

$sql = "SELECT * FROM user where id = '$id' and pwd = '$pwd'";
$result = mysqli_query($conn, $sql); // run SQL statement

if(mysqli_num_rows($result) > 0) // if login name and password can be found in table "user"
{
	echo "<h2>Authentication success!</h2>";
}
else
{
	echo "<h2>Wrong password, authentication failed</h2>";
}
mysqli_close($conn);
?>
</body>
</html>
