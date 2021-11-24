<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>VotazioneProgettiDiClasse</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/styles.css">
        <script src="https://kit.fontawesome.com/e2a2c802cf.js" crossorigin="anonymous"></script>
    </head>
    <body>
    <div class="row" style="background: var(--bs-teal)">
        <form action='dispatcher.php' method='post' style="margin-bottom: 0px">
        <div class="col-md-12 d-md-flex justify-content-md-center align-items-center" style="text-align: center">
            <h1>Votazione progetto di classe</h1>
            <?php
                session_start();
                if(isset($_COOKIE['token'])) {
                    echo "<input type='hidden' name='action' value='logout'>";
                    echo "<button class='btn btn-danger' type='submit'>Logout</button>";
                }
            ?>
        </div>
        </form>
    </div>