
<?php require_once 'app/Templates/partials/header.template.php'; ?>

    <h3>Login to our super safe database</h3>

    <form action="/login" method="post">

        <label for="user">Enter name: </label>

        <br>

        <input type="text" id="name" name="name" value="name"

        /><br>

        <label for="user">Enter email: </label>

        <br>

        <input type="email" id="email" name="email" value="email"

        /><br>

        <label for="password">Enter password: </label><br>
        <input type="password" id="password" name="password" value="password"

        <label for="passwordVerification">Re-enter password: </label><br>
        <input type="password" id="passwordVerification" name="passwordVerification" /><br><br>

        /><br>

        <p>Male or female? Choose below.</p>
        <label for="gender">
            <select name="gender">
                <option value="male" name="male">male</option>
                <option value="female" name="female">female</option>
            </select>
        </label>
        <br>

        <input type="submit" name="login" value="login" />

    </form>



