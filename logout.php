<?php
// logout.php
session_start();

// Destroy session and redirect to homepage
session_unset();
session_destroy();
header("Location: index.php");
exit();
?>