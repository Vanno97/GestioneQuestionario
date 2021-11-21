<?php
    require_once "DatabaseConnection.php";
    $listaProgetti = array();
    $questionario = '';
    $nomeQuestionario = '';
    if(isset($_GET)) {
        if(isset($_GET['questionarioId'])) {
            $questionario = filter_input(INPUT_GET, 'questionarioId', FILTER_SANITIZE_STRING);
            $querySelectQuestionario =  "SELECT * FROM `questionario` WHERE  `questionario_id` = $questionario";
            $querySelectProgetti = "SELECT * FROM `progetti` WHERE `questionario` = $questionario";
            $connection = DatabaseConnection::getConnection();
            $resultQuestionario = $connection->query($querySelectQuestionario);
            if($resultQuestionario->num_rows!=0) {
                $rowQuestionario = $resultQuestionario->fetch_array(MYSQLI_ASSOC);
                $nomeQuestionario = $rowQuestionario['nome_questionario'];
                if($result = $connection->query($querySelectProgetti)) {
                //var_dump($result);
                    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                        $progetto['progettoId'] = $row['progetto_id'];
                        $progetto['nomeProgetto'] = $row['nome_progetto'];
                        $progetto['dettagliImplementativi'] = $row['dettagli_implementativi'];
                        $progetto['questionario'] = $row['questionario'];
                        $listaProgetti[] = $progetto;
                    }
                }
            } else {
                setcookie("errore","Questionario non trovato");
                header('Location: index.php');
            }
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
            <form action="conferma.php" method="post">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Compulazione del questionario: <?php echo $nomeQuestionario ?></h4>
                        <p>Inserisci nome</p>
                        <input name="nomePersona" class="form-control" type="text"/>
                        <br/>
                        <h6 class="text-muted card-subtitle mb-2">Vota Un progetto</h6>
                        <?php foreach ($listaProgetti as $value):?>
                        <div>
                            <div class="d-md-flex justify-content-start align-items-md-center">
                                <h3 style="margin-bottom: 0px;">
                                    <?php echo $value['nomeProgetto'];?>
                                    <br/>
                                </h3>
                                <input name="scelta" type="radio" style="margin-left: 20px;" value="<?php echo $value['progettoId'] ?>">
                            </div>
                            <div>
                                <p style="margin-left: 20px">
                                    <?php echo $value['dettagliImplementativi'];?>
                                </p>
                            </div>
                        </div>
                        <input type="hidden" name="questionario" value="<?php echo $value['questionario']?>"/>
                        <?php endforeach; ?>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit" style="margin-top:10px;">Invia Scelta</button>
            </form>
        </div>
        <div class="col"></div>
    </div>
    </body>
</html>