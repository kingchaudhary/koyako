<?php
    ob_start();
    session_start();
    $username = $_SESSION['username'];
    echo "$username";
    if(!isset($_SESSION['username'])){
      header("Location:index.php");
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <title></title>
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

        if(isset($_POST['submitNumPeople'])) {
          $numPersone = $_POST['numeroPersone'];
          $count = 0;
          $_SESSION['numeroPersone'] = $numPersone;
          
          if($numPersone<=2) {
            $tav = "SELECT numero FROM tavoli WHERE posti=2";
          } else if($numPersone>2 && $numPersone<5){
            $tav = "SELECT numero FROM tavoli WHERE posti=4";
          } else {
            $tav = "SELECT numero FROM tavoli WHERE posti=6";
          }

          $result = mysqli_query($conn, $tav);
          while($row = mysqli_fetch_array($result)){
            $tavolo = $row['numero'];
            echo '<script type="text/javascript">';
            echo ' alert("Il suo tavolo è il numero "'.$tavolo.')';  //not showing an alert box.
            echo '</script>';
            $_SESSION['tavolo'] = $tavolo;
            $pasto = "INSERT INTO pasti(oraInizio, totale, username, dataP) VALUES (CURRENT_TIME, 0, '$username', CURRENT_DATE)";
            mysqli_query($conn, $pasto);
            $idPasto = "SELECT idP FROM pasti WHERE oraInizio=CURRENT_TIME AND username='$username";
            $idP = mysqli_query($conn, $idPasto);
            $_SESSION['idP'] = $idP;
            $occupazione = "INSERT INTO occupazioni(idP, tavolo) VALUES ($idP, $tavolo)";
            mysqli_query($conn, $occupazione);
            break;
          }

          header("Location: addPeople.php");
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

    <div>
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="w3-container w3-card-4 w3-yellow w3-text-black w3-margin">
        <label class="container">
          <h2 style="font-family: 'Reggae One';">Effetuerai ordini solo per te stesso? </h2>
        </label>
        <select name="persone">
          <option value="1"> SI </option>
          <option value="0"> NO </option>
        </select>
        
        <label class="container">Inserisci la tua temperatura corporea</label>
        <input type="number" step="0.1" name="temperatura" id="temperatura" placeholder="Qui" class="w3-input-half w3-border" style="width: 900px; height: 40px">

        <button type="submit" name="submit" id="submit" style="height: 40px">INVIA</button>
      </form>
    </div>
    <div>
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="w3-container w3-card-4 w3-yellow w3-text-black w3-margin">
        <?php 
          include("config/db.php");

          if(isset($_POST['submit'])){
              $persone = $_POST['persone'];
              $temperatura = $_POST['temperatura'];
      
              $query = "INSERT INTO temperature(temperatura, dataT, username) VALUES ('$temperatura', CURRENT_DATE, '$username')";
      
              $result = mysqli_query($conn, $query) or die("Failed");
      
              if($persone == '1') {
                $tav = "SELECT numero FROM tavoli WHERE posti=2";
                $result = mysqli_query($conn, $tav);
                while($row = mysqli_fetch_array($result)){
                  $tavolo = $row['numero'];
                  echo $tavolo;
                  echo '<script type="text/javascript">';
                  echo ' alert("Il suo tavolo è il numero "'.$tavolo.')';  //not showing an alert box.
                  echo '</script>';
                  $_SESSION['tavolo'] = $tavolo;
                  break;
                }
          
                $pasto = "INSERT INTO pasti(oraInizio, totale, username, dataP) VALUES (CURRENT_TIME, 0, '$username', CURRENT_DATE)";
                mysqli_query($conn, $pasto);
                $idPasto = "SELECT idP FROM pasti WHERE dataP=CURRENT_DATE AND username='$username";
                $idP = mysqli_query($conn, $idPasto);
                $_SESSION['idP'] = $idP;
                $occupazione = "INSERT INTO occupazioni(idP, tavolo) VALUES ($idP, $tavolo)";
                mysqli_query($conn, $occupazione);
                header("Location: menu.php");
              } else {
                echo '<label class="container"><h2>Con quante altre persone sei?</h2></label>';
                echo '<input type="number" name="numeroPersone" id="numeroPersone" placeholder="Qui" class="w3-input-half w3-border" style="width: 900px; height: 40px">';
                echo '<button type"submit" name="submitNumPeople" id="submitNumPeople" style="height: 40px">INVIA</button>';

                //header("Location: addPeople.php");
              }
          }
        ?>
      </form>
    </div>
    <div>
          
    </div>
  </body>
</html>