<?php
    //echo md5("GestioneProgetti");
?>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width", initial-scale=1.0, shrink-to-fir=no"/>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="assets/css/styles.css"
    </head>
    <body>
        <div class="row" style="background: rgb(13,110,253); color: var(--bs-white);">
            <div class="col" style="text-align: center;">
                <h1>Votazione progetto</h1>
            </div>
        </div>
        <div class="row">
            <div class="col"></div>
            <div class="col-md-7">
                <br/>
                <?php
                    if(isset($_COOKIE['errore'])) {
                        echo $_COOKIE['errore'];
                    }
                    setcookie('errore','');
                ?>
                <form action="questionario.php" method="get">
                    <div class="card">
                        <div class="card-body" style="text-align: center;">
                            <h4 class="card-title">Inserici ID questionario per aprilo</h4>
                            <input class="form-control" type="text" name="questionarioId">
                            <button class="btn btn-primary" type="submit" style="padding-top: 6px; margin-top: 15px; background: rgb(13,110,253">Apri</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </body>
</html>