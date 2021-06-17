<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
    .log-zero {
        width: 490px;
    }

    .cont {
        align-self: center;
    }
</style>
<link href="css/logo.css" rel="stylesheet" type="text/css">

<body style="background-color: #645818;">
<div style="float: left;">
    <div class="log">
        <h1 class="logo"> KOYAKO </h1>
    </div>
</div>

<div style="margin-top: 0cm">
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" class="w3-container w3-card-4 w3-transparent w3-text-orange w3-margin" style="background-color: #645815;">
    
    <div class="w3-row w3-section">
    <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
        <div class="w3-rest">
        <input class="w3-input w3-border" name="nome" type="text" placeholder="INSERIRE NOME">
        </div>
    </div>

    <div class="w3-row w3-section">
    <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
        <div class="w3-rest">
        <input class="w3-input w3-border" name="cognome" type="text" placeholder="INSERIRE COGNOME">
        </div>
    </div>

    <div class="w3-row w3-section">
    <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-phone"></i></div>
        <div class="w3-rest">
        <input class="w3-input w3-border" name="telefono" type="text" placeholder="INSERIRE TELEFONO">
        </div>
    </div>

    <div class="w3-row w3-section">
    <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-envelope-o"></i></div>
        <div class="w3-rest">
        <input class="w3-input w3-border" name="username" type="text" placeholder="INSERIRE USERNAME">
        </div>
    </div>

    <div class="w3-row w3-section">
    <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-pencil"></i></div>
        <div class="w3-rest">
        <input class="w3-input w3-border" name="password" type="password" placeholder="INSERIRE PASSWORD">
        </div>
    </div>

    <button class="w3-button w3-block w3-section w3-orange w3-ripple w3-padding" type="submit" value="submit" name="submit">REGISTRAMI</button>

    </form>
</div>

<div class="cont">
        <img src="img/reg-img.PNG" style="width: 300px;">
        <img src="img/reg-img-2.png" class="log-zero">
        <img src="img/reg-img-4.png" style="width: 400px;">
        <img src="img/reg-img-5.png" style="width: 300px;">
</div>

<?php 
    include("config/db.php");

    if(isset($_POST['submit'])) {
        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $telefono = $_POST['telefono'];

        $query = "INSERT INTO clienti(username, pass, nome, cognome, telefono) VALUES ('$username', '$password', '$nome', '$cognome', '$telefono')";

        if(mysqli_query($conn, $query)){
            header('Location: login.php');
        } else {
            die ("Failed");
        }
    }
?>

</body>
</html> 