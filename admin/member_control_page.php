<?php
include("../utils.php");
include("../connect_db.php");
session_start();
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
        <h1>COVID-19 vaccination - Manage Member </h1>
        <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px auto;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
        </style>
        <table>
            <tr>
                <th></th>
                <th>ID</th>
                <th>Name</th>
                <th>Role</th>
                <th></th>
                <th></th>

            </tr>

            <?php

            // SQL query to select data from the table
            $sql = "SELECT id,username, role FROM users";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><button class='editButton' data-id='" . $row['id'] . "'>Edit</button></td>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td><input type='text' id='username" . $row['id'] . "' name ='username' value='" . $row['username'] . "' disabled></td>";
                    echo "<td>";
                    echo "<select class='roleSelect' disabled>";
                    echo "<option value='staff' " . ($row['role'] === 'staff' ? 'selected' : '') . ">Staff</option>";
                    echo "<option value='admin' " . ($row['role'] === 'admin' ? 'selected' : '') . ">Admin</option>";
                    echo "</select>";
                    echo "</td>";
                    echo "<td><button id ='deleteBtn'class='myButton' data-deleteId='" . $row['id'] . "'>Delete</button></td>";
                    echo "<td><button id ='updateBtn'class='myButton' data-updateId='" . $row['id'] . "'>Update</button></td>";
                    
                    echo "</tr>";
                }
            } else {
                echo "No data found.";
            }

            $conn->close();
            ?>
            <script>
            // JavaScript code to handle button clicks
            const deleteBtn = document.querySelectorAll("#deleteBtn");
            const updateBtn = document.querySelectorAll("#updateBtn");
            deleteBtn.forEach(button => {
                button.addEventListener("click", function() {
                    const id = this.getAttribute("data-deleteId");
                    // Call your function with the id here
                    // alert("Button clicked with ID: " + id);
                    var confirmed = confirm("Are you sure you want to delete this record?");
                    if (confirmed) {
                        $.ajax({
                            type: "POST",
                            url: "delete_member_process.php",
                            data: {
                                action: "delete",
                                id: id
                            },
                            success: function(response) {
                                alert('delete success'); // Display the response message
                                // You can also update the table or perform other actions on success
                            },
                            error: function() {
                                alert("An error occurred.");
                            }
                        });
                    }
                });
            });

            updateBtn.forEach(button => {
                button.addEventListener("click", function() {
                    const id = this.getAttribute("data-updateId");
                    var row = $(this).closest("tr");
                    var username = $("#username" + id).val()
                    var role = row.find(".roleSelect").val();
                    // Call your function with the id here
                    // alert("Button clicked with ID: " + username);
                    var confirmed = confirm("Are you sure you want to delete this record?");
                    if (confirmed) {
                        $.ajax({
                            type: "POST",
                            url: "delete_member_process.php",
                            data: {
                                action: "update",
                                id: id,
                                username: username,
                                role: role
                            },
                            success: function(response) {
                                alert('update success'); // Display the response message
                                // You can also update the table or perform other actions on success
                            },
                            error: function() {
                                alert("An error occurred.");
                            }
                        });
                    }
                });
            });

            $(".editButton").on("click", function() {
                var row = $(this).closest("tr");
                var inputs = row.find("input");
                var roleSelect = row.find(".roleSelect");

                // Check the current state of the input fields
                var isDisabled = inputs.prop("disabled");

                // Toggle the input fields' disabled state
                inputs.prop("disabled", !isDisabled);
                roleSelect.prop("disabled", !isDisabled);

                // Change the button text based on the new state
                if (isDisabled) {
                    $(this).text("Save");
                } else {
                    $(this).text("Edit");
                }
            });
            </script>
        </table>
    </div>
</body>

</html>