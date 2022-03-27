<?php
/** @var mysqli $db */
//Er wordt verbinding gemaakt met de database
require_once "database.php";

// De id wordt opgehaald en de variabele wordt tot een array gemaakt
$index = $_GET['index'];

if (isset($_GET['index'])) {
    $reservation_Id = $_GET['index'];

    $query = "SELECT * FROM reservations WHERE id='$reservation_Id'";
    $result = $db->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $name = htmlspecialchars($row['name']);
            $surname = htmlspecialchars($row['surname']);
            $phone_number = htmlspecialchars($row['phone_number']);
            $adress = htmlspecialchars($row['adress']);
            $postalCode = htmlspecialchars($row['postalcode']);
            $city = htmlspecialchars($row['city']);
            $residence = htmlspecialchars($row['residence']);
            $date = htmlspecialchars($row['date']);
            $reservation_Id = htmlspecialchars($row['reservation_Id']);
        }

    }
}
//Er wordt een if statement gebruikt om de gegevens te posten uit de database
//De gegevens zijn  veilig, omdat er sql injecties gebruikt worden
if (isset($_POST['submit'])) {
    $name = mysqli_escape_string($db, $_POST['name']);
    $surname = mysqli_escape_string($db, $_POST['surname']);
    $phone_number = mysqli_escape_string($db, $_POST['phone_number']);
    $adress = mysqli_escape_string($db, $_POST['adress']);
    $postalCode = mysqli_escape_string($db, $_POST['postalcode']);
    $city = mysqli_escape_string($db, $_POST['city']);
    $residence = mysqli_escape_string($db, $_POST['residence']);
    $date = mysqli_escape_string($db, $_POST['date']);

//De query wordt opgebouwd om de gegevens in de edit page te updaten
    $query = "UPDATE reservations SET name ='$name', surname='$surname',
    adress= '$adress',postalcode= '$postalCode', city='$city', residence='$residence', date='$date' WHERE id ='$index'";

    //De query wordt uitgevoerd voor het updaten van de wijzigingen
    $result = mysqli_query($db, $query) or die('Error: ' . mysqli_error($db) . ' with query ' . $query);


    //Als deze query wordt  uitgevoerd wordt het door een if statement naar de detail.php gestuurd met der gewijzigde gegevens.
    if ($result) {
        header('Location: detail.php');
    } else {
        $errors['db'] = 'Something went wrong in your database query: ' . mysqli_error($db);
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <title>Reservation Edit</title>
<!--    <meta charset="utf-8"/>-->
    <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <link rel="stylesheet" type="text/css" href="style3.css"/>
</head>
<body>
<ul>
    <li><a href="index.php">OnlineBabyBeursReservatie.com</a></li>
    <li><a href="contact.php">Contact</a></li>
    <li><a href="profiel.php">Profiel</a></li>
</ul>
<h1>Wijzig Reservatie</h1>

<form action="" method="post">
    <div class="data-field">
        <label for="name">Naam</label>
        <input id="name" type="text" name="name" value="<?= $name ?>"/>
    </div>
    <div class="data-field">
        <label for="surname">Achternaam</label>
        <input id="surname" type="text" name="surname" value="<?= $surname ?>"/>
    </div>

    <div class="data-field">
        <label for="phone_number">Telefoonnummer</label>
        <input id="phone_number" type="number" name="phone_number" value="<?= $phone_number ?>"/>
    </div>
    <div class="data-field">
        <label for="adress">Adres</label>
        <input id="adress" type="text" name="adress" value="<?= $adress ?>"/>
    </div>
    <div class="data-field">
        <label for="postalcode">Postcode</label>
        <input id="postalcode" type="text" name="postalcode" value="<?= $postalCode ?>"/>
    </div>
    <div class="data-field">
        <label for="city">Stad</label>
        <input id="city" type="text" name="city" value="<?= $city ?>"/>
    </div>
    <div class="data-field">
        <label for="residence">Woonplaats</label>
        <input id="residence" type="text" name="residence" value="<?= $residence ?>"/>
    </div>
    <div class="data-field">
        <label for="date">Datum</label>
        <input id="date" type="datetime-local" name="date" value="<?= $date ?>"/>
    </div>

    <div class="data-submit">

        <input type="hidden" name="id" value=""/>
        <input name="submit" type="submit" value="Save"/>

    </div>
</form>
<div>

</div>
</body>
</html>
