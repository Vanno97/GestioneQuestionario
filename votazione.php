<?php
include "header.php";
if(!isset($_COOKIE['token'])) {
    header('Location: index.php');
}
?>

<div class="row">
    <div class="row">
        <div class="col"></div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title" style="color: white;">Sondaggio per il progetto della classe: CLASSE</h4>
                    <h6 class="text-muted card-subtitle mb-2" style="color: lightgrey !important;">Fai una votazione</h6>
                    <form action="dispatcher.php" method="post">
                        <input type="hidden" name="action" value="vota">
                        <div class="mb-3 form-floating">
                            <input class="form-control visible loginInput" type="text" name="nome" id="nome" readonly placeholder="Nome" value="<?php echo $_SESSION['username'] ?>">
                            <label class="form-label" for="nome">Nome</label>
                        </div>
                        <?php
                            if(isset($_COOKIE['questionarioSelezionato'])) {
                                $questionarioSelezionato = $_COOKIE['questionarioSelezionato'];
                                require_once "controller/ProgettoController.php";
                                $progettiController = new ProgettoController();
                                $listaProgetti = $progettiController->getAllByQuestionario($questionarioSelezionato);
                            } else {
                                header('Location: user-dashboard.php');
                            }
                        ?>

                        <?php
                            require_once "controller/VotazioneController.php";
                            $votazioneController = new VotazioneController();
                            $checkVote = $votazioneController->checkVote($_SESSION['user_id']);
                        ?>
                        <?php if(!$checkVote): ?>
                            <?php foreach ($listaProgetti as $item) : ?>
                            <div class="row">s
                                <div class="col-11 col-md-10 float-start">
                                    <div class="row">
                                        <div class="col">
                                            <h5 style="color: white;"><?php echo $item->getNomeProgetto()?></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="text-muted mb-2 ps-5 dettagliProgetto" style="color: lightgrey !important;"><?php echo $item->getDettagliImplementativi()?></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1 col-md-2 float-start d-md-flex justify-content-sm-center justify-content-md-center align-items-md-center">
                                    <input required type="radio" name="scelta" style="height: 17.8px; width: 17.8px;" value="<?php echo $item->getIdProgetto()?>">
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <button class="btn btn-success mt-3" type="submit">Invia</button>
                        <?php else: ?>
                            <h5 style="color: white;">HAI GIà VOTATO</h5>
                        <?php endif;?>
                    </form>
                </div>
            </div>
        </div>
        <div class="col"></div>
    </div>
</div>

<?php
include "footer.php";
?>

