<?php
include("../utils.php");
include("../connect_db.php");
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

</head>


<body>
    <div class="container" style="margin-top:50px">
        <h1>COVID-19 vaccination - Update Member </h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>

            <?php

            // SQL query to select data from the table
            $sql = "SELECT id,username, role FROM users";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['role'] . "</td>";
                    echo "<button></button>";
                    echo "</tr>";
                }
            } else {
                echo "No data found.";
            }

            $conn->close();
            ?>
        </table>
    </div>
    <div class="container" style="margin-top:50px">
        <h1>COVID-19 vaccination - Delete Member </h1>
        <form action="delete_member_process.php" method="post" id="form1">
            <div class="form-group">

                <div class="form-group">
                    <label for="username">Username </label>
                    <input type="text" class="form-control" name="username" id="username" />
                </div>
                <div class="form-group">
                    <label for="username">Password </label>
                    <input type="password" class="form-control" name="password" id="password" />
                </div>
                <button class="btn btn-primary" type="submit" name="submit">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>