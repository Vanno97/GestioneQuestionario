<?php
    require_once ("../DatabaseConnection.php");
    session_start();
    if(isset($_SESSION)) {
        if(isset($_SESSION['token'])) {
            header('Location: crea-questionario.php');
        }
    }
    $username = '';
    $password = '';
    $errormsg = '';
    if(isset($_POST)) {
        if(isset($_POST['username']) && isset($_POST['username'])) {
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            $connection = DatabaseConnection::getConnection();
            $query_login = "SELECT * FROM `utenti` WHERE `username` = $username AND `password` = $password";
            if(!$result = $connection->query($query_login)) {
                $token = md5(rand(0,1000000) . "9UVb2jfABKQsK/oFChGrM53/JjneTwhr7AxAwRhENIdcR0bZZBr3TkK28YKwbdAUJOy7Cjyhf9PTQViQTrBpEg==");
                $_SESSION['token'] = $token;
                header('Location: crea-questionario.php');
            }
        }
    }
?>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width", initial-scale=1.0, shrink-to-fir=no"/>
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="../assets/css/styles.css"
    </head>
    <body>
        <div class="row" style="background: rgb(13,110,253); color: var(--bs-white);">
            <div class="col" style="text-align: center;">
                <h1>Votazione Progetto</h1>
            </div>
        </div>
        <div class="row">
            <div class="col"></div>
            <div class="col-md-7">
                <br/>
                <form action="index.php" method="post">
                    <label for="username" class="form-label">Username</label>
                    <input id="username" name="username" class="form-control" type="text" placeholder="Username"/>
                    <label for="password" class="form-label">Password</label>
                    <input id="password" name="password" class="form-control" type="password" placeholder="Password"/>
                    <br/>
                    <button class="btn btn-success" type="submit">Login</button>
                </form>
                <?php echo $errormsg ?>
            </div>
            <div class="col"></div>
        </div>
    </body>
</html>