<?php

if(isset($_POST['submit'])) {
//Er wordt verbinding gemaakt met de database
    require_once "database.php";


    /** @var mysqli $db */

    // Elke rij wordt beveiligd door een sql injectie en gepost
    $name = mysqli_escape_string($db, $_POST['name']);
    $surname =mysqli_escape_string($db, $_POST['surname']);
    $phone_number = mysqli_escape_string($db, $_POST['phone_number']);
    $adress = mysqli_escape_string($db, $_POST['adress']);
    $postalCode =mysqli_escape_string($db, $_POST['postalcode']);
    $city =mysqli_escape_string($db, $_POST['city']);
    $residence=mysqli_escape_string($db, $_POST['residence']);
    $date =mysqli_escape_string($db, $_POST['date']);

    //Als de array leeg is wordt er een error gewezen om gegevens in te vullen waar leeg is.
    $errors = [];
    if($name == '') {
        $errors['name'] = 'Voer een naam in';
    }if($surname == '') {
        $errors['surname'] = 'Voer een achternaam in';
    }

    if($phone_number == '') {
        $errors['phone_number'] = 'Voer een telefoonnummer in';
    }
    if($city== '') {
        $errors['city'] = 'Voer een stad in';
    }
    if($residence == '') {
        $errors['woonplaats'] = 'Voer een woonplaats in';
    }
    if($date == '') {
        $errors['datum'] = 'Voer een datum in';
    }

    //Er wordt hier een query opgebouwd om gegeven in te vullen in de database.
    $query = "INSERT INTO reservations (name, surname, phone_number, adress, postalcode, city, residence,date ) 
VALUES ( '$name', '$surname', '$phone_number', '$adress', '$postalCode', '$city', '$residence', '$date' )";



// De query wordt hier uitgevoerd en als iets verkeerd gaat komt er een error te staan op de page
    $result = mysqli_query($db, $query) or die('Error: '.mysqli_error($db). ' with query ' . $query);

    //Als de query is uitgevoerd wordt je gebracht naar de detail.php en als dat niet gebeurd wijst het dat er een fout is in de database
    if ($result) {
        header('Location: detail.php');
    } else {
        $errors['db'] = 'Something went wrong in your database query: ' . mysqli_error($db);
    }

    // De database wordt afgesloten omdat het niet meer nodig is
    mysqli_close($db);


}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewpart"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>OnlineBabyBeurs.com</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="style2.css"/>


</head>
<body>
<ul>
    <li><a href="index.php">OnlineBabyBeursReservatie.com</a></li>
    <li><a href="contact.php">Contact</a></li>
    <li><a href="profiel.php">Profiel</a></li>
</ul>
<h2>Reserveer Hier! </h2>
<form action="" method="post">
    <div class="data-field">
        <label for="name">Naam</label>
        <input id="name" type="text" name="name" required value= "<?= $name ?? '' ?>"/>

        <span class="errors"><?= $errors['name'] ?? '' ?></span>
    </div>
    <div class="data-field">
        <label for="surname">Achternaam</label>
        <input id="surname" type="text" name="surname" required value="<?= $surname?? '' ?>"/>

        <span class="errors"><?= $errors['surname'] ?? '' ?></span>
    </div>


    <div class="data-field">
        <label for="phone_number">Telefoonnummer</label>
        <input id="phone_number" type="text" name="phone_number" required value="<?= $phone_number?? '' ?>"/>
        <span class="errors"><?= $errors['phone_number'] ?? '' ?></span>
    </div>
    <div class="data-field">
        <label for="adress">Adres</label>
        <input id="adress" type="text" name="adress" required value="<?= $adress?? '' ?>"/>
        <span class="errors"><?= $errors['adress'] ?? '' ?></span>
    </div>
    <div class="data-field">
        <label for="postalcode">Postcode</label>
        <input id="postalcode" type="text" name="postalcode" required value="<?= $postalCode?? '' ?>"/>
        <span class="errors"><?= $errors['postalcode'] ?? '' ?></span>
    </div>
    <div class="data-field">
        <label for="city">Stad</label>
        <input id="city" type="text" name="city" required value="<?= $city?? '' ?>"/>
        <span class="errors"><?= $errors['city'] ?? '' ?></span>
    </div>
    <div class="data-field">
        <label for="residence">Woonplaats</label>
        <input id="residence" type="text" name="residence" required value="<?= $residence?? '' ?>"/>
        <span class="errors"><?= $errors['residence'] ?? '' ?></span>
    </div>
    <div class="data-field">
        <label for="date">Datum</label>
        <input id="date" type="datetime-local" name="date" required value="<?= $date?? '' ?>"/>
        <span class="errors"><?= $errors['date'] ?? '' ?></span>
    </div>


    <div class="data-submit">
        <a href="reserveren.php">
            <input  type="submit" name="submit" value="Reserveer"/>
        </a>




    </div>


</form>

</body>
</html>

