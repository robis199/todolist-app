
<?php require_once 'app/Templates/Partials/header.template.php'; ?>
<?php require_once 'app/Templates/Partials/loggedin.template.php'; ?>

    <h1>Submit your personal data to our safe system</h1>

    <form action="/record" method="post">

        <label for="user">Username: </label><br>
        <input type="text" id="user" name="user" /><br>
        <label for="password">Password: </label><br>
        <input type="password" id="password" name="password" /><br>
        <label for="passwordVerify">Repeat password: </label><br>
        <input type="password" id="passwordVerification" name="passwordVerification" /><br><br>

        <button><input type="submit" name="register" value="Register" /></button>

    </form>

