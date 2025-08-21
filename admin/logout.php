<?php
session_start();
unset($_SESSION['admin']);
session_destroy();
header("Location: ../home.php"); // Redirect to homepage or login
exit();
?>
