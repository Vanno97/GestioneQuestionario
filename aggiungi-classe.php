<?php
include "header.php";
if(!isset($_COOKIE['token'])) {
    header('Location: index.php');
}
?>

<div class="row">
    <div class="col"></div>
    <div class="col-md-6">
        <div class="card md-6">
            <div class="card-body">
                <div class="d-flex justify-content-between mt-3">
                    <h4 class="card-title" style="color: white;">Aggiungi una classe</h4>
                    <a href="admin-dashboard.php" class="btn btn-primary" type="submit">Vai alla dahboard</a>
                </div>
                <h6 class="text-muted card-subtitle mb-2" style="color: lightgrey !important;">Nome della classe</h6>
                <form action="dispatcher.php" method="post">
                    <div class="mb-3 form-floating">
                        <input type="hidden" name="action" value="insertClasse">
                        <input class="form-control loginInput" type="text" id="nome" name="nomeClasse" placeholder="Nome classe">
                        <label class="form-label" for="nome">Nome classe</label>
                    </div>
                    <button class="btn btn-success mt-3" type="submit">Aggiungi classe</button>
                </form>
                <?php
                    if(isset($_COOKIE['insrimentoClasse'])) {
                        echo "<h4 class='card-title' style='color: white;'>";
                        echo $_COOKIE['insrimentoClasse'];
                        echo '</h4>';
                        setcookie("insrimentoClasse", "");
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="col"></div>
</div>

<?php
include "footer.php";
?>
