<?php
session_start();
unset($_SESSION['loggedin_name']);
header('Location:test.php');
?>