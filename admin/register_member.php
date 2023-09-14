<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <script src="https://hcaptcha.com/1/api.js" async defer></script>
  <title>Add Member</title>
</head>


<body>
  <p>Insert information::</p>
  <form action="register_member_process.php" method="post" id="form1">
    <table width="400" border="0" cellpadding="5">
      <tr>
        <td width="90">Name</td>
        <td width="294"><label for="username"></label>
          <input type="text" name="username" id="username" />
        </td>
      </tr>
      <tr>
        <td>Password</td>
        <td><input type="text" name="password" id="password" /></td>
      </tr>
      <tr>
        <td>
          <div class="h-captcha" data-sitekey="64d4483e-46bf-4e85-8182-f00bced152a9"></div>
        </td>
      </tr>
      <tr>
        <td><input name="submit" type="submit" value="submit"></td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </form>
</body>

</html>