<?php
    if(isset($_POST['user'])) {
        echo md5($_POST['user']);
    }
?>
<form action="register.php" method="post">
    <input type="text" name="user" placeholder="user">
    <button type="submit">Crea</button>
</form>