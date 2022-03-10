<?php

// Check if form is submitted.
if (isset($_POST['submit'])) {
    /** @var mysqli $db */
    require_once 'pages/database.php';
    // 'Post back' with the data from the form.
    $name = mysqli_escape_string($db, $_POST['name']);
    $surname =  mysqli_escape_string($db,$_POST['surname']);
    $adress = mysqli_escape_string($db, $_POST['adress']);
    $email =  mysqli_escape_string($db,$_POST['e-mail']);
    $phoneNumber =  mysqli_escape_string($db,$_POST['phone_number']);

    $query = "INSERT INTO reservations(name, surname, adress, e-mail, phone_number)
    VALUE ('$name', '$surname', '$adress', '$email', '$phoneNumber')";
    $result = mysqli_query($db, $query) or die('Error: '.mysqli_error($db). ' with query ' . $query);
    if ($result) {
        header('Location: index.php');
        exit;
    } else {
        $errors['db'] = 'Something went wrong in your database query: ' . mysqli_error($db);
    }
    mysqli_close($db);
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Music Collection Create</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
<h1>Create album</h1>
<?php if (isset($errors['db'])) { ?>
    <div><span class="errors"><?= $errors['db']; ?></span></div>
<?php } ?>

<!-- enctype="multipart/form-data" no characters will be converted -->
<form action="" method="post" enctype="multipart/form-data">
    <div class="data-field">
        <label for="name">Name</label>
        <input id="name" type="text" name="name" value="<?= isset($name) ? htmlentities($name) : '' ?>"/>
        <span class="errors"><?= $errors['name'] ?? '' ?></span>
    </div>
    <div class="data-field">
        <label for="surname">Surname</label>
        <input id="surname" type="text" name="surname" value="<?= isset($surname) ? htmlentities($surname) : '' ?>"/>
        <span class="errors"><?= isset($errors['surname']) ? $errors['surname'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="adress">Adress</label>
        <input id="adress" type="text" name="adress" value="<?= isset($adress) ? htmlentities($adress) : '' ?>"/>
        <span class="errors"><?= isset($errors['adress']) ? $errors['adress'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="e-mail">E-mail</label>
        <input id="e-mail" type="text" name="e-mail" value="<?= isset($email) ? htmlentities($email) : '' ?>"/>
        <span class="errors"><?= isset($errors['e-mail']) ? $errors['e-mail'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="phonenumber">Phone number</label>
        <input id="phonenumber" type="number" name="phonenumber" value="<?= isset($phoneNumber) ? htmlentities($phoneNumber) : '' ?>"/>
        <span class="errors"><?= isset($errors['phone_number']) ? $errors['phone_number'] : '' ?></span>
    </div>

    <div class="data-submit">
        <input type="submit" name="submit" value="Save"/>
    </div>
</form>
<div>
    <a href="index.php">Go back to the list</a>

    // Check if form is submitted.
