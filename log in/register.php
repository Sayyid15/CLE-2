<?php
// if  statement wordt gebruikt om de data te kunnen posten
if(isset($_POST['submit'])) {

    //Er wordt verbinding gemaakt met de database
    $db = mysqli_connect('localhost', 'root', '', 'onlinebabybeurs')
    or die('Error: ' . mysqli_connect_error());

    /** @var mysqli $db */
// De variabele email en password worden gemaakt tot een array met een post. En bij de variabele email is er een sql injectie
    $email = mysqli_escape_string($db, $_POST['email']);
    $password = $_POST['password'];

    //Als de array leeg is wordt er een error gewezen om gegevens in te vullen waar leeg is.
    $errors = [];
    if($email == '') {
        $errors['email'] = 'Voer een gebruikersnaam in';
    }
    if($password == '') {
        $errors['password'] = 'Voer een wachtwoord in';
    }

    //Deze if statement is er om de password te kunnen hashen, zodat andere mensen de password van u niet weten.
    if(empty($errors)) {
        $password = password_hash($password, PASSWORD_DEFAULT);

        //Query wordt opgebouwd om de email en password op te slaaan in de database
        $query = "INSERT INTO accounts (email, password) VALUES ('$email', '$password')";

        //Query wordt uitgevoerd en als het niet gegaan is gaat het een error aangven in de query
        $result = mysqli_query($db, $query)
        or die('Db Error: '.mysqli_error($db).' with query: '.$query);

        //if statement is er als er geregistreerd is dat de gebruiker gestuurd wordt naar de login in pagina om in te loggen
        if ($result) {
            header('Location: inlog.php');
            exit;
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../pages/style3.css"/>
    <title>Registreren</title>
</head>
<body>
<ul >
    <li><a href="../pages/index.php">OnlineBabyBeursReservatie.com</a></li>
    <li><a href="../pages/contact.php">Contact</a></li>
    <li><a href="../pages/profiel.php">Profiel</a></li>
</ul>
<h2>Nieuwe gebruiker registeren</h2>
<form action="" method="post">
    <div class="data-field">
        <label for="email">Email</label>
        <input id="email" type="text" name="email" value="<?= $email ?? '' ?>"/>
        <span class="errors"><?= $errors['email'] ?? '' ?></span>
    </div>
    <div class="data-field">
        <label for="password">Wachtwoord</label>
        <input id="password" type="password" name="password" value="<?= $password ?? '' ?>"/>
        <span class="errors"><?= $errors['password'] ?? '' ?></span>
    </div>
    <div class="data-submit">
        <input type="submit" name="submit" value="Registreren"/>
    </div>
</form>

</body>
</html>