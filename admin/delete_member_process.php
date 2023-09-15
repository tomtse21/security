<?php
include("../connect_db.php");
include("../utils.php");

?>
<?php
/* Get form data */
$id = $_POST['id'];

$delete_query = "Delete users  where id =(?)";
$s_stmt = $conn->prepare($delete_query);
$s_stmt->bind_param("s", $id, $id);

if ($s_stmt->execute()) {
    echo "<script>alert('done');</script>";

} else {
    echo "Error: " . $s_stmt->error;
}

?>