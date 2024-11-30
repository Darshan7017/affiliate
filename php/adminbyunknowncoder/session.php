<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
function logged_in() {
return isset($_SESSION['email']);
 
}
function confirm_logged_in() {
if (!logged_in()) {
    echo '<script>window.location="login.php";</script>';

}
}
?>