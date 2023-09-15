<?php
include("../utils.php");
checkAuthentication();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <title>COVID-19 vaccination booking system </title>

  <!-- Include Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
  <!-- Include Bootstrap CSS from a CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Include Bootstrap Datepicker CSS and JavaScript files -->
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

  <!-- ✅ load jQuery ✅ -->
  <!-- Include jQuery from a CDN -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

  <!-- Include jQuery UI from a CDN -->
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <script src="https://hcaptcha.com/1/api.js" async defer></script>
  <title>Add Member</title>
</head>

<body>
  <div class="container" style="margin-top:50px">
    <h1>COVID-19 Admin System</h1>
    <p>Insert information:</p>
    <form action="register_member_process.php" method="post" id="form1" onsubmit="return validateForm()">
      <table width="400" border="0" cellpadding="5">
        <tr>
          <td width="90">Name</td>
          <td width="294"><label for="username"></label>
            <input type="text" name="username" id="username" />
          </td>
        </tr>
        <tr>
          <td>Password</td>
          <td><input type="password" name="password" id="password" /></td>
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
  </div>
  <script>
    const passwordInput = document.getElementById('password'); // Replace 'password' with the actual input field ID
    const passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

    function validateForm() {
      return true;
      const password = $("#password").val();
      const isValid = passwordPattern.test(password);
      if (isValid == false) {
        alert("Please use strong password(combination of symbols, uppercase lowercase letters.)");

      }
      return isValid;
    }

  </script>

</body>

</html>