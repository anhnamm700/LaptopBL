<?php
    session_start();

    if (isset($_SESSION['email'])) {
        session_destroy();
        header('location: Login.php');
    } else {
        header('location: Login.php');
    }
?>