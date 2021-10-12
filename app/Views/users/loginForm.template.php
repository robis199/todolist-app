
<?php require_once 'app/Views/partials/header.template.php'; ?>

    <h1>Login Form</h1>
    <form action="/login" method="post">

        <label for="user">Enter name: </label>

        <br>

        <input type="text" id="user" name="user" value="password"

        /><br>

        <label for="password">Enter password: </label><br>
        <input type="password" id="password" name="password" value="password"

        /><br>

        <br>

        <input type="submit" name="login" value="login" />

    </form>



