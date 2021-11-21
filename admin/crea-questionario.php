<?php
    require_once "../DatabaseConnection.php";
    session_start();
    if(!isset($_SESSION['token'])) {
        header('Location: index.php');
    }
    $questionario = '';
    $nomeQuestionarioToInsert = '';
    if(isset($_POST)) {
        if (isset($_POST['token'])) {
            if($_POST['token'] == $_SESSION['token']) {
                if (isset($_POST['nomeQuestionario'])) {
                    $nomeQuestionarioToInsert = $_POST['nomeQuestionario'];
                    $queryRead = "SELECT `questionario_id` FROM `questionario`";
                    $connection = DatabaseConnection::getConnection();
                    $listaId = array();
                    if (!$result = $connection->query($queryRead)) {
                        while (!$row = $result->fetch_array()) {
                            $listaId[] = $row['questionario_id'];
                        }
                    }
                    do {
                        $rand = rand(0, 1000);
                        $questionarioIdTemp = "75001" . $rand;
                    } while (in_array($questionarioIdTemp, $listaId));
                    $questionarioId = $questionarioIdTemp;
                    $queryinsert = "INSERT INTO `questionario`(`questionario_id`, `nome_questionario`) VALUES ('$questionarioId','$nomeQuestionarioToInsert')";

                    if ($resultInsert = $connection->query($queryinsert)) {
                        $questionario = $nomeQuestionarioToInsert;
                    }
                }
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
        <div class="row" style="background: rgb(13,110,253);color: var(--bs-white);">
            <div class="col"></div>
            <div class="col-md-7" style="text-align: center;">
                <h1>Votazione progetto</h1>
            </div>
            <div class="col d-md-flex align-items-md-center">
                <button class="btn btn-danger" type="submit">Logout</button>
            </div>
        </div>
        <div class="row">
            <div class="col"></div>
            <div class="col-md-7">
                <?php
                $sceltaQuestionario = <<<EOD
                <form action="crea-questionario.php" method="post">
                    <div class="card-body">
                        <h4 class="card-title">Inserisci questionario</h4>
                        <div class="d-md-flex justify-content-around align-items-center form-group">
                            <p>Nome del quesionario</p>
                            <input name="nomeQuestionario" class="form-control" type="text" placeholder="Nome"/>
                        </div>
                        <p>Oppure scegline uno che già esiste</p>
                        <select class="form-select">
                            <option value="ciao">Ciao</option>
                        </select>
                        <br/>
                        <button class="btn btn-success" type="submit">Conferma</button>
                        <input type="hidden" name="token" value="{$_SESSION['token']}">
                    </div>
                </form>
EOD;
                $inserisciScelta = <<<EOD
                    
                <form>
                    <div class="row">
                        <div class="card-body">
                            <h4 class="card-title">Inserisci scelta</h4>
                            <h6 class="text-muted card-subtitle mb-2">Titolo progetto</h6>
                            <input class="form-control" type="text">
                            <p>Dettagli implementativi</p>
                            <textarea></textarea>
                            <br/>
                            <br/>
                            <div class="d-md-flex justify-content-around">
                                <button class="btn btn-primary" type="button">Aggiungi</button>
                                <button class="btn btn-success" type="button">Salva</button>
                            </div>
                            <input type="hidden" name="token" value="{$_SESSION['token']}">
                        </div>
                    </div>
                </form>
EOD;

                    if(empty($questionario)) {
                        echo $sceltaQuestionario;
                    } else {
                        echo $inserisciScelta;
                    }
                ?>
            </div>
            <div class="col"></div>
        </div>
    </body>
</html>