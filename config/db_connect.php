<?php

$connection = mysqli_connect('localhost', 'roberts', 'robis199', 'todo_list');


if(!$connection)
{
    echo "Connection error: " . mysqli_connect_error();
}