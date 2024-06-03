<?php
// session_start();
// include 'config.php';

session_start();
if(empty($_SESSION['aname']) || $_SESSION['aname'] == ''){
    header("Location: test.php");
    die();
}

?>