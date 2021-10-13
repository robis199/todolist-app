<?php
require_once 'app/Templates/Partials/header.template.php';
require_once 'app/Templates/Partials/loggedin.template.php';






if(!isset($_SESSION['user_name'])){
    header('Location: /success');
}


?>

    <h4>You have successfully logged in!</h4>
    <form action="/" method="get">
        <button value="confirm">Confirm</button>
    </form>

<?php

