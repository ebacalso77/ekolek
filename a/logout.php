<?php
session_start();
include "../connection.php";
if (isset($_SESSION['user_id'])) {
    unset($_SESSION['user_id']);
}
session_destroy();
session_unset();
header("location: index.php");
