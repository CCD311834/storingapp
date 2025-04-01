<?php

session_start();
$username = $_POST['username'];
$password = $_POST['password'];

//Hier komt een query

if($statement->rowCount() < 1)
{
 die("Error: account bestaat niet");
}

if(!password_verify($password, $user['password']))
{
 die("Error: wachtwoord niet juist!");
}

$_SESSION['user_id'] = $user['id'];

?>