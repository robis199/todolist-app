
<?php

require_once 'app/Views/Partials/header.template.php';
require_once 'app/Views/Partials/loggedin.template.php';




?>

    <?php foreach($users->getAll() as $user): ?>

    <?php echo "<ul>Name: <b>{$user->getName()}</b>"; ?>
    <?php echo "(id:<small>{$user->getId()}</small>)</ul>"; ?>

<?php endforeach; ?>





