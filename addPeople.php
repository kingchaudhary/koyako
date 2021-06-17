<?php
    ob_start();
    session_start();
    $username = $_SESSION['username'];
    $count = $_SESSION['numeroPersone'];
    echo "$count";
    echo "$username";
    $tavolo = $_SESSION['tavolo'];
    if(!isset($_SESSION['username'])){
      header("Location:index.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link type="text/css" rel="stylesheet" href="css/forms.css">
        <link type="text/css" rel="stylesheet" href="css/logo.css">

        <style>
        .nome {
            margin-top: 30px;
            margin-right: 30px;
            float: right;
        }
        </style>
    </head>
    <body style="background-color: #da9f56;">

        <?php 
            include("config/db.php");

            if(isset($_POST['submitPerson'])){
                $nome = $_POST['nomeO'];
                $cognome = $_POST['cognomeO'];
                $temperatura = $_POST['temperaturaO'];
                $u = $nome.$cognome;

                $query = "INSERT INTO clienti(username, pass, nome, cognome) VALUES ('$u', '**', '$nome', '$cognome')";

                if(mysqli_query($conn, $query)){
                    $queryT = "INSERT INTO temperature(temperatura, dataT, username) VALUES ('$temperatura', CURRENT_DATE, '$u')";
                    if(mysqli_query($conn, $queryT)){
                        $count--;
                        $_SESSION['numeroPersone'] = $count;
                        echo "<h2>".$count."</h2>";
                        //header("refresh");
                        if($_SESSION['numeroPersone'] == 0) {
                            header("Location: menu.php");
                        }
                    } else {
                        echo "Failed";
                    }
                } else {
                    echo "Failed";
                }
            }
        ?>

        <div style="float: left;">
            <div class="log">
                <h1 class="logo"> KOYAKO </h1>
            </div>
        </div>
        <div style="float: right;">
            <div class="nome">
                <h2 style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">Ciao <?php echo strtoupper($_SESSION['name']); ?>!</h2>
            </div>
        </div>
        <?php 
            for($i=0; $i<5; $i++){
                echo '<br>';
            }
        ?>
        <div>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" style="margin-left: 200px;">
                <label><h2>Aggiunga i dati di tutte le persone per le quali ordinerà</h2></label>
                <label>Premere sul tasto per aggiungere i dati di una persona</label>
                <button type="submit" id="openPage" name="openPage" style="height: 60px"><img src="img/outline_person_add_black_24dp.png"></button>
            </form>
        </div>

        <div>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" style="margin-left: 200px;">
                <?php 
                    include("config/db.php");

                    if(isset($_POST['openPage'])){
                        echo '<label>Nome</label><br>';
                        echo '<input type="text" name="nomeO" id="nomeO" placeholder="Qui" class="w3-input-half w3-border" style="width: 900px; height: 40px"><br>';
                        echo '<label>Cognome</label><br>';
                        echo '<input type="text" name="cognomeO" id="cognomeO" placeholder="Qui" class="w3-input-half w3-border" style="width: 900px; height: 40px"><br>';
                        echo '<label>Temperatura</label><br>';
                        echo '<input type="number" step="0.1" name="temperaturaO" id="temperaturaO" placeholder="Qui" class="w3-input-half w3-border" style="width: 900px; height: 40px"><br>';
                        echo '<button type"submit" name="submitPerson" id="submitPerson" style="height: 40px">INVIA</button>';
                    }
                ?>
            </form>
        </div>


    </body>
</html>