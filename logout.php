<?php
session_start();
unset($_SESSION["email"]);
unset($_SESSION["name"]);
unset($_SESSION["password"]);
session_destroy();
header("Location:login.php");
?>