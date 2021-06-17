<?php
   ob_start();
   session_start();
?>

<!DOCTYPE html>
<html>

  <head>
    <title>Koyako - Login</title>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link href="css/login.css" rel="stylesheet" type="text/css">
    <link href="css/logo.css" rel="stylesheet" type="text/css">
  </head>

  <body>

    <?php
        $msg = '';

        include("config/db.php");
                    
        if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
                        
            $username = $_POST["username"];
            $password = $_POST["password"];
                        
            $query = "SELECT * FROM clienti WHERE clienti.username = '$username' AND clienti.pass = '$password'";

            $result = mysqli_query($conn, $query) or die ("Failed Query of " . $query);
            
            while($row = mysqli_fetch_assoc($result)) {
                $_SESSION['valid'] = true;
                $_SESSION['logged_in'] = 'YES';
                $_SESSION['timeout'] = time();
                $_SESSION["username"] = $username;
                $_SESSION["name"] = $row["nome"];
                header('Location: question.php');
            }
            include("php/funzioni.php");
        }
    ?>

    <div class="log">
        <h1 class="logo"> KOYAKO </h1>
    </div>
    
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 login-key">
                    <i class="fa fa-key" aria-hidden="true"></i>
                </div>
                <div class="col-lg-12 login-title"> Ristorante Koyako </div>
 
                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">
                            <div class="form-group">
                                <label class="form-control-label">USERNAME</label>
                                <input type="text" class="form-control" id="username" name="username">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">PASSWORD</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
 
                            <div class="col-lg-12 loginbttm">
                                <div class="col-lg-6 login-btm login-text">
                                    <!-- Error Message -->
                                </div>
                                <div class="col-lg-6 login-btm login-button">
                                    <button type="submit" class="btn btn-outline-primary" value="Log In" name="login">ACCEDI</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2"></div>
            </div>
        </div>
  </body>
</html>