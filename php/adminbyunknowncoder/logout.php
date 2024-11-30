<?php
 
session_start();
 
// 2. Unset all the session variables
unset($_SESSION['id']);
?>
<script type="text/javascript">
alert("Successfully logout!");
window.location = "login.php";
</script>