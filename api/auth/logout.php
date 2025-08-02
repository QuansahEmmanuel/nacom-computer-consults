<?php
session_start();
$_SESSION = [];
session_destroy();

// Send to correct login page (adjust as needed)
header("Location: http://localhost/nacom-computer-consults/views/auth/login.php?msg=You have been logged out.");

exit;