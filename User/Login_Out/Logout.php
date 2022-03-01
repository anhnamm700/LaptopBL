<?php
    // session_start();

    // var_dump($_SESSION['emailAcc']); exit;

    if (isset($_SESSION['emailAcc'])) {
        session_destroy();
        echo("<script>location.href = 'index.php';</script>");
    } else {
        echo("<script>location.href = 'index.php';</script>");
    }
?>