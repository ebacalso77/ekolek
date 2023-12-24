<?php
session_start();
include "../connection.php";

if (isset($_SESSION['username'])) {

    $_SESSION = array();

    // Destroy the session
    session_unset();
    session_destroy();
    header("Location: ../u/user.php");
    exit(); // Terminate the current script
} else {
    header("Location: ../u/user.php");
    exit();
}



