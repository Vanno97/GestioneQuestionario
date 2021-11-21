<?php
    require_once "DatabaseConnection.php";
    $message = '';
    $nome = '';
    $scelta = '';
    if(isset($_POST)) {
        if(isset($_POST['nomePersona'])){
            if(isset($_POST['scelta'])) {
                $error = false;
                $nome = filter_input(INPUT_POST, 'nomePersona', FILTER_SANITIZE_STRING);
                $scelta = $_POST['scelta'];
                $questionario = $_POST['questionario'];
                $queryInsert = "INSERT INTO `scelte`(`nome`, `sceltaProgetto`, `questionario`) VALUES ('$nome','$scelta','$questionario')";
                $connection = DatabaseConnection::getConnection();
                if(!$result = $connection->query($queryInsert)) {
                    $message = $connection->error;
                } else {
                    $message = "Dati inseriti corretamente";
                }
            } else {
                $message = $message . "Non hai fatto una scelta <br/>";
            }
        } else {
            $message = $message . "Errore non hai inserito il nome <br/>";
        }
    }
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
    <div class="row" style="text-align: center; ">
        <h1>Votazione progetto</h1>
    </div>
</div>
<div class="row">
    <div class="col"></div>
    <div class="col-md-7">
        <br/>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><?php echo $message?></h4>
                    <br/>
                </div>
            </div>
    </div>
    <div class="col"></div>
</div>
</body>
</html>