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
                    <h6 class="text-muted card-subtitle mb-2" style="color: lightgrey !important;">Votazione completata</h6>
                    <a class="btn btn-primary" href="index.php">Vai alla home</a>
                </div>
            </div>
        </div>
        <div class="col"></div>
    </div>
</div>

<?php
include "footer.php";
?>

