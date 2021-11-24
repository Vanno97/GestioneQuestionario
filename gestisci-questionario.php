<?php
include "header.php";
if(!isset($_COOKIE['token'])) {
    header('Location: index.php');
}
?>

<div class="row">
    <div class="col"></div>
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-body">
                <h4 class="card-title" style="color: white !important;">Aggiungi progetto</h4>
                <h6 class="text-muted card-subtitle mb-2" style="color: lightgrey !important;">Inserisci il nome del progetto</h6>
                <form action="dispatcher.php" method="post">
                    <input type="hidden" name="action" value="insertProgetto">
                    <input type="hidden" name="questionario" value="<?php echo $_COOKIE['questionarioSelezionato'] ?>">
                    <div class="mb-3 form-floating">
                        <input class="form-control loginInput" type="text" id="nome" name="nomeProgetto" placeholder="Nome progetto">
                        <label class="form-label" for="nome">Nome progetto</label>
                    </div>
                    <h6 class="text-muted mb-2" style="color: lightgrey !important;">
                        Inserisci i dettagli implementativi del progetto
                    </h6>
                    <div class="mb-3 form-floating">
                        <input class="form-control loginInput" type="text" id="dettagli" name="dettagli" placeholder="Dettagli implementativi">
                        <label class="form-label" for="dettagli">Dettagli implementativi</label>
                    </div>
                    <button class="btn btn-success mt-3" type="submit">Aggiungi progetto</button>
                </form>
            </div>
        </div>
        <?php
            require_once "controller/ProgettoController.php";
            $progettoController = new ProgettoController();
            $listaProgetti = $progettoController->getAllByQuestionario($_COOKIE['questionarioSelezionato']);
            if(!empty($listaProgetti)):
        ?>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex d-lg-flex justify-content-between align-items-lg-center">
                        <h4 style="color: white;">Lista progetti</h4>
                        <i id="openProjectList" class="fas fa-arrow-down" style="color: white" onclick="apriMenu()"></i>
                    </div>
                    <div class="row">
                        <div class="col-11 col-md-10 col-lg-12 float-start">
                            <div class="row hidden" id="listaProgetti">
                                <div class="col-1"></div>
                                <div class="col progetto">
                                    <?php foreach ($listaProgetti as $item) : ?>
                                    <div class="row">
                                        <div class="col">
                                            <h5 style="colo: white;"><?php echo $item->getNomeProgetto() ?></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="text-muted mb-2 ps-5 dettagliProgetto" style="color: lightgrey !important;"><?php echo $item->getDettagliImplementativi()?></h6>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="col-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="card-title" style="colo:white;">Togli un progetto</h4>
                    <h6 class="text-muted card-subtitle mb-2" style="color: lightgrey !important;">Scegli il progetto da togliere</h6>
                    <form action="dispatcher.php" method="post">
                        <input type="hidden" name="action" value="deleteProgetto">
                        <select class="form-select" name="progetto">
                            <?php foreach ($listaProgetti as $item): ?>
                                <option value="<?php echo $item->getIdProgetto() ?>"><?php echo $item->getNomeProgetto()?></option>
                            <?php endforeach; ?>
                        </select>
                        <button class="btn btn-danger mt-3" type="submit">Elimina</button>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="col"></div>
</div>

<?php
include "footer.php";
?>

