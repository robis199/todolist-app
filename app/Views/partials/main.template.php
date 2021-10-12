<?php


if(isset($_SESSION['user_name'])): ?>
    <div>
        <a href="/add">Add User</a><br>
        <a href="/users">All Users</a><br>
    </div>

<?php endif; ?>

<div>
    <a href="/records">Register</a><br>
</div>