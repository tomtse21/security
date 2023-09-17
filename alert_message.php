  <script>
// Check if the session variable is set
<?php if (isset($_SESSION['alert_message'])) : ?>
// Display the alert message
alert("<?php echo $_SESSION['alert_message']; ?>");
<?php
        // Unset the session variable to remove it after displaying
        unset($_SESSION['alert_message']);
    endif;
    ?>
  </script>