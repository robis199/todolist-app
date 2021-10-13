
<?php

require_once 'app/Templates/Partials/header.template.php';
require_once 'app/Templates/Partials/loggedin.template.php';




?>

    <?php foreach($users->getAll() as $user): ?>

    <?php echo "<ul>Name: <b>{$user->getName()}</b>"; ?>
    <?php echo "(id:<small>{$user->getId()}</small>)</ul>"; ?>

<?php endforeach; ?>





