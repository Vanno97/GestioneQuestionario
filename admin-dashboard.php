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
                <h4 class="card-title" style="color: white">Aggiungi un questionario</h4>
                <h6 class="text-muted card-subtitle mb-2" style="color:lightgrey !important;">Inserisci il nome del questionario</h6>
                <form action="dispatcher.php" method="post">
                    <input type="hidden" name="action" value="insertQuestionario">
                    <div class="mb-3 form-floating">
                        <input class="form-control visible loginInput" type="text" id="nomeQuestionario" name="nomeQuestionario" placeholder="Nome questionario">
                        <label class="form-label" for="nomeQuestionario">Nome questionario</label>
                    </div>
                    <h4 style="color: white">Scegli la classe a cui assegnare il questionario</h4>
                    <select class="form-select" name="classe">
                        <?php
                            require_once "controller/ClasseController.php";
                            $classeControler = new ClasseController();
                            $listaClassi = $classeControler->getAll();
                            foreach ($listaClassi as $value):
                        ?>
                            <option value='<?php echo $value->getIdClasse()?>'><?php echo $value->getNomeClasse()?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="d-flex justify-content-between mt-3">
                        <button class="btn btn-success align-self-start" type="submit">Crea questionario</button>
                        <a class="btn btn-primary" href="aggiungi-classe.php">Aggiungi classe</a>
                    </div>
                </form>
            </div>
            <?php
                require_once "controller/QuestionarioController.php";
                $questionarioController = new QuestionarioController();
                $listaQuestionari = $questionarioController->getAll();
                if(!empty($listaClassi)) :
            ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" style="color: white !important;">Oppure scegli un questionario già esistente</h4>
                        <form action="dispatcher.php" method="post">
                            <input type="hidden" name="action" value="mostraQuestionario">
                            <select class="form-select" name="questionario">
                                <?php foreach ($listaQuestionari as $item): ?>
                                    <option value="<?php echo $item->getIdQuestionario()?>"><?php echo $item->getNomeQuestionario() ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="d-flex justify-content-between mt-3">
                                <button class="btn btn-success" type="submit">Gestisci</button>
                                <a class="btn btn-primary" href="#">Mostra risultati</a>
                            </div>
                        </form>
                    </div>
                </div>
            <?php
                endif;
            ?>
        </div>
    </div>
    <div class="col"></div>
</div>

<?php
include "footer.php";
?>
