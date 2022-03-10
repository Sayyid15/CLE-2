<?php

/** @var mysqli $db */
//Require music data to use variable in this file
require_once "database.php";

$index= $_GET['index'];

if (isset($_POST['submit'])) {

$email = mysqli_escape_string($db, $_POST['email']);
$password = $_POST['password'];
if(empty($errors)) {
    $password = password_hash($password, PASSWORD_DEFAULT);
}



$query = "UPDATE accounts SET email ='$email', password='$password' WHERE id ='$index'";

$result = mysqli_query($db, $query) or die('Error: '.mysqli_error($db). ' with query ' . $query);
if ($result) {
header('Location: profiel.php');}
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Profiel Edit</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style3.css"/>
</head>
<body>
<ul >
    <li><a href="index.php">OnlineBabyBeursReservatie.com</a></li>
    <li><a href="contact.php">Contact</a></li>
    <li><a href="profiel.php">Profiel</a></li>
</ul>
<h1>Edit Account</h1>

<form action="" method="post">
    <div class="data-field">
        <label for="email">E-mail</label>
        <input id="email" type="email" name="email" value=""/>
    </div>
    <div class="data-field">
        <label for="password">Wachtwoord</label>
        <input id="password" type="password" name="password" value=""/>


        <div class="data-submit">

            <input type="hidden" name="id" value=""/>
            <input name="submit" type="submit" value="Save"/>

        </div>
</form>
<div>

</div>
</body>
</html>
