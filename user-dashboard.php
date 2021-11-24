<?php
include "header.php";
if(!isset($_COOKIE['token'])) {
    header('Location: index.php');
}
?>

<div class="row">
    <div class="col"></div>
    <div class="col-md-6">
        <div class="card-body">
            <h4 class="card-title" style="color:white;">Scegli il progetto per cui vuoi votare</h4>
            <form>
                <?php
                    require_once "controller/QuestionarioController.php";
                    $questionarioController = new QuestionarioController();
                    //print_r($_COOKIE);
                    //$utente = $_COOKIE['user'];
                    //$listaQuestionari = $questionarioController->getAllByClasse($utente->getClassi[0]);
                    //echo $utente->getClassi[0];
                ?>
                <select class="form-select">
                    <option value="">Progetto</option>
                </select>
            </form>
        </div>
    </div>
    <div class="col"></div>
</div>

<?php
include "footer.php";
?>
