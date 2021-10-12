
<?php require_once 'app/Views/Partials/header.template.php'; ?>
<?php require_once 'app/Views/Partials/loggedin.template.php'; ?>
    <h1>Submit your personal data to our safe system</h1>
    <form action="/register" method="post">
        <label for="username">Username: </label><br>
        <input type="text" id="username" name="username" /><br>
        <label for="password">Password: </label><br>
        <input type="password" id="password" name="password" /><br>
        <label for="passwordVerify">Repeat password: </label><br>
        <input type="password" id="passwordVerification" name="passwordVerification" /><br><br>

        <button><input type="submit" name="register" value="Register" /></button>
    </form>

