<?php 
 require('session.php');
 confirm_logged_in(); 
include_once '../db.php';
$sql = "DELETE FROM aff WHERE id='" . $_GET["id"] . "'";
if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Deleted Successfully');</script>";
        echo '<meta http-equiv="refresh" content="0; url=affs.php">';
} else {
    echo "Error deleting ";
}

?>