<?php
include "header.php";
if(!isset($_COOKIE['token'])) {
    header('Location: index.php');
}
?>

<div class="row">
    <div class="col"></div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title" style="color:white;">Scegli il progetto per cui vuoi votare</h4>
                <form action="dispatcher.php" method="post">
                    <?php
                        require_once "controller/QuestionarioController.php";
                        $questionarioController = new QuestionarioController();
                        $classe = $_COOKIE['classe'];
                        $listaQuestionari = $questionarioController->getAllByClasse($classe);
                    ?>
                    <input type="hidden" name="action" value="sceltaQuestionario">
                    <select class="form-select" name="questionarioSelezionato">
                        <?php foreach ($listaQuestionari as $item): ?>
                            <option value="<?php echo $item->getIdQuestionario() ?>"><?php echo $item->getNomeQuestionario() ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button class="btn btn-success mt-3" type="submit">Invia</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col"></div>
</div>

<?php
include "footer.php";
?>
