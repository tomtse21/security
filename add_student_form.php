<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add student</title>
</head>


<body>
<p>Insert student information::</p>
<form action="add_student_success.php" method="post" id="form1"> 
<table width="400" border="0" cellpadding="5">
  <tr>
    <td width="90">Student Name</td>
    <td width="294"><label for="name"></label>
    <input type="text" name="name" id="name" /></td>
  </tr>
  <tr>
    <td>Age</td>
    <td><input type="text" name="age" id="age" /></td>
  </tr>
  <tr>
    <td><input name="submit" type="submit" value="submit"></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>