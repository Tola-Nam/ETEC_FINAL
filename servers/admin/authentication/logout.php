<?php
session_start();
session_destroy();
header("Location: http://localhost/ETEC_FINAL/servers/admin/authentication/login.php");
?>