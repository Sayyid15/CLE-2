<?php

/** @var mysqli $db */


//Require data from this file
require_once "database.php";

if (!isset($_GET['index']) || $_GET['index'] == '') {

    // Id was not present in the url OR the form was not submitted

    // redirect to profilepage.php
    header('Location: delete.php');
    exit;

} else {
    //Retrieve the GET parameter from the 'Super global'
    $accountId = mysqli_escape_string($db, $_GET['index']);

    //Get the record from the database result
    $query = "DELETE FROM accounts  WHERE ID = '$accountId'";
    $result = mysqli_query($db, $query) or die ('Error: ' . $query);

    // redirect when conn returns no result
    header('Location: profiel.php');
    exit;

}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delete - <?= $name['name'] ?></title>
</head>
<body>
<h2>Delete - <?= $name['name'] ?></h2>
<form action="" method="post">
    <p>
        Weet u zeker dat u het account"<?= $name['name'] ?>" wilt verwijderen?
    </p>
    <input type="hidden" name="id" value="<?= $name['ID'] ?>"/>
    <input type="submit" name="submit" value="Verwijderen"/>
</form>

</body>
</html>