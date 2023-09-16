<?php
include("../connect_db.php");
include("../utils.php");

?>


<?php 

// if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    // Include your database connection code here

    // Check if a valid action is specified in the AJAX request
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        // Perform the action based on the value of 'action'
        if ($action === 'update') {
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                $username = $_POST['username'];
                $role = $_POST['role'];
                // Perform the delete operation here (e.g., SQL DELETE query)
               
                $update_user_query = "UPDATE  users  set username = (?) , role = (?) where id = (?)";

                $s_stmt = $conn->prepare($update_user_query);
                $s_stmt->bind_param("sss", $username,$role, $id);

                if ($s_stmt->execute()) {
                    echo "<script>alert('update finish');</script>";

                } else {
                    echo "Error: " . $s_stmt->error;
                }
                        
            } else {
                echo "Invalid request: 'id' parameter missing.";
            }
        } else {
            echo "Invalid action specified.";
        }

                // Perform the action based on the value of 'action'
        if ($action === 'delete') {
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                // Perform the delete operation here (e.g., SQL DELETE query)
                
                $delete_query = "DELETE FROM users  where id =(?)";
                $s_stmt = $conn->prepare($delete_query);
                $s_stmt->bind_param("s", $id);

                if ($s_stmt->execute()) {
                    echo "<script>alert('Deleted');</script>";

                } else {
                    echo "Error: " . $s_stmt->error;
                }
                        
            } else {
                echo "Invalid request: 'id' parameter missing.";
            }
        } else {
            echo "Invalid action specified.";
        }
        
    } else {
        echo "No action specified.";
    }

?>