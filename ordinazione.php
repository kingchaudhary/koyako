<?php
    ob_start();
    session_start();
    $username = $_SESSION['username'];
    echo "$username";
    if(!isset($_SESSION['username'])){
      header("Location:index.php");
    }

    include("config/db.php");
    $nome = $_POST['nomeCibo'];
    $query = "INSERT INTO ordinazioni(idP, idC) VALUES ((SELECT pasti.idP FROM pasti WHERE pasti.username='$username' AND pasti.dataP=CURRENT_DATE), (SELECT menu.idC FROM menu WHERE menu.nome='$nome')); ";
    mysqli_query($conn, $query);
    header("Location: menu.php");
?>