<?php
/** @var mysqli $db */
// Er wordt verbinding gemaakt met de database.
require_once "database.php";

// De query wordt opgebouwd om de data op te halen
$query = "SELECT * FROM reservations";

//De query  wordt uitgevoerd.
$result = mysqli_query($db, $query) or die ('Error: ' . $query);

//Tabel reservations omzetten naar een array
$reservations = [];
while ($row = mysqli_fetch_assoc($result)) {
    //Elke reservering wordt aan de array(reservations) toegevoegd.
    $reservations[] = $row;
}

//De database wordt afgesloten, omdat het niet meer nodig is.
mysqli_close($db);





?>
<!doctype html>
<html lang="en">
<head>
    <title>Reservation Edit</title>
    <meta charset="utf-8"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>
<!--    <meta name="viewpart"-->
<!--          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>-->
    <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" type="text/css" href="style4.css"/>
</head>
<body>
<ul >
    <li><a href="index.php">OnlineBabyBeursReservatie.com</a></li>
    <li><a href="contact.php">Contact</a></li>
    <li><a href="profiel.php">Profiel</a></li>
</ul>



<a href="detail.php"></a>
<table>
    <tr>
        <th>Naam</th>
        <th>Achternaam</th>
        <th>Telefoonnummer</th>
        <th>Adres</th>
        <th>Postcode</th>
        <th>Stad</th>
        <th>Woonplaats</th>
        <th>Datum</th>
        <th>Delete</th>
        <th>Edit</th>
    </tr>
    <?php
    foreach ($reservations as $index => $reservation){

    //  htmlspecialchars is voor beveiliging tegen xss aanvallen in de website
    ?>
    <tr>

        <td><?= $reservation['name'] ?></td>
        <td><?= $reservation['surname']?></td>
        <td><?= $reservation['phone_number']?></td>
        <td><?= $reservation['adress']?></td>
        <td><?= $reservation['postalcode']?></td>
        <td><?= $reservation['city']?></td>
        <td><?= $reservation['residence']?></td>
        <td><?= $reservation['date']?></td>
        <td><a href="delete.php?index=<?=$reservation['id']?>">delete</a> </td>
        <td><a href="Edit.php?index=<?=$reservation['id']?>">edit</a> </td>
        <?php }?>
    </tr>

</table>
</div>
</body>
</html>
