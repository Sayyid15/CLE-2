<?php
require_once "pages/database.php";
session_start();
/** @var $db */

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

if (!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $result = mysqli_query($db, "SELECT * FROM accounts WHERE id= $id");
    $row = mysqli_fetch_assoc($result);
}

$query = "SELECT * FROM reservations";

$result = mysqli_query($db, $query) or die('Error: ' . mysqli_error($db) . ' with query ' . $query);
?>
<!doctype html>
<html lang="en">
<head>
    <title>Reservation Edit</title>
    <meta charset="utf-8"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>
    <meta name="viewpart"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" type="text/css" href="style4.css"/>
</head>
<body>
<ul>
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
    <tbody>
    <?php
    if ($result->num_rows > 0){
    while ($row = $result->fetch_assoc()){
    ?>
    <tr>

        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['surname']) ?></td>
        <td><?= htmlspecialchars($row['phone_number']) ?></td>
        <td><?= htmlspecialchars($row['adress']) ?></td>
        <td><?= htmlspecialchars($row['postalcode']) ?></td>
        <td><?= htmlspecialchars($row['city']) ?></td>
        <td><?= htmlspecialchars($row['residence']) ?></td>
        <td><?= htmlspecialchars($row['date']) ?></td>
        <td class="tdbut"><a class="buttonDelete" href="delete.php?index=<?= htmlspecialchars($row['id']) ?>">delete</a></td>
        <td><a href="Edit.php?index=<?= $row['id'] ?>">edit</a></td>
        <?php }
        }
        ?>
    </tr>
    </tbody>
</table>
</div>
</body>
</html>

