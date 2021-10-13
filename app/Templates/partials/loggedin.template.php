<?php


if(isset($_SESSION['user_name'])){
    echo "You have logged in, {$_SESSION['user_name']}! ";
    echo "<a href='/logout'>Logout</a><br>";
} else {
    echo "Viewing as guest";
    echo "<a href='/login'>Login</a><br>";
}