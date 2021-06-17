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

      .cibi {
          margin-top: 30px;
          background-color: white;
          width: 600px;
      }

      .principal {
          margin-left: 460px;
      }
    </style>

    <script>
        function ordinazione(){
            location.href='ordinazione.php';
        }
    </script>
    </head>

    <body style="background-color: #BA0505;">
        <a href="main.php"><div style="float: left;">
            <div class="log">
                <h1 class="logo"> KOYAKO </h1>
            </div>
        </div></a>
        <div style="float: right;">
            <div class="nome">
                <h2 class="logo">Benvenuto!</h2>
            </div>
        </div>

        <?php 
            for($i=0; $i<2; $i++) {
                echo "<br>";
            }
        ?>

        <div style="margin-left: 300px;">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" style="width: 800px;">
                    <?php 
                        include("config/db.php");

                        $query = "SELECT categoria FROM menu WHERE 1 GROUP BY categoria";
                        $result = $conn->query($query);
                        echo '<select style="width: 720px; height: 40px;" class="w3-input-half w3-border" name="categoria" id="categoria">';
                        echo '<option value="" disabled selected hidden>Scegliere categoria</option>';
                        while ($row = $result->fetch_array()) {
                            echo "<option value='$row[categoria]'>'$row[categoria]'</option>";
                        }
                        echo '</select>';
                    ?>
                <!--<input type="text" name="categoria" id="categoria" placeholder="Scegliere categoria" class="w3-input-half w3-border" style="width: 700px; height: 40px">-->
                <button type="submit" name="submitCategoria" id="submitCategoria" style="background-color: #da9f56; width: 50px; height: 40px;" class="w3-input-half w3-border"><img src="img/outline_search_black_24dp.png"></button>
            </form>
        </div>

        <?php 
            for($i=0; $i<5; $i++) {
                echo "<br>";
            }
        ?>

        <div class="principal">
            <?php 
                include("config/db.php");

                if(isset($_POST['submitCategoria'])) {

                    $categoria = $_POST['categoria'];
                    $query = "SELECT nome, descrizione, prezzo, immagine FROM menu WHERE categoria='$categoria'";
                    $result = mysqli_query($conn, $query);

                    while($row = $result->fetch_array()) {
                        echo '<div class="cibi">';
                        echo '<img src="data:image/jpg;base64,'.base64_encode( $row["immagine"] ).'" style="width: 600px;"/>';
                        echo '<h3 style="margin-left: 40px">'.strtoupper($row['nome']).'</h3>';
                        echo '<p style="margin-left: 40px;">'.strtoupper($row['descrizione']).'</p>';
                        echo '</div>';
                    }
                }
            ?>
        </div>
    </body>
</html>