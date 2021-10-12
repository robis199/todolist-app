<?php
require_once 'app/Views/Partials/header.template.php';
require_once 'app/Views/Partials/loggedin.template.php';






if(!isset($_SESSION['user_name'])){
    header('Location: /loginView');
}


?>

    <h4>You have successfully logged in!</h4>
    <form action="/" method="get">
        <button value="confirm">Confirm</button>
    </form>

<?php

