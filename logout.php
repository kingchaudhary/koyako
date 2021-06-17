<?php
    session_start();
    include("config/db.php");
    $username = $_SESSION['username'];
    $query = "UPDATE pasti SET oraFine=CURRENT_TIME WHERE username='$username'";
    mysqli_query($conn, $query);

    unset($_SESSION["username"]);
    unset($_SESSION["password"]);

    header('Refresh: 2; URL = /ayce/main.php');
?>