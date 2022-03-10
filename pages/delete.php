<?php
/** @var mysqli $db */
//Require data from this file
//Er wordt verbinding gemaakt met database
require_once "database.php";

//Er wordt een if statement gebruikt voor het ophalen van de id.
if (!isset($_GET['index']) || $_GET['index'] == '') {

    header('Location: detail.php');
    exit;
} else {
//De id van de reservatie wordt opgehaald uit de database.En er wordt een sql injectie gebruikt
    $reservationId = mysqli_escape_string($db, $_GET['index']);

    //De query om de data te verwijderen wordt opgebouwd
    $query = "DELETE FROM reservations  WHERE ID = '$reservationId'";

    //De query voor het verwijderen van de id en de reservatie wordt uitgevoerd
    $result = mysqli_query($db, $query) or die ('Error: ' . $query);
    //Als de Query is uitgevoerd blijf je op de detail.php
    header('Location: detail.php');
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
    <title>Delete - <?= htmlspecialchars($reservationId['name']) ?></title>
</head>
<body>
<h2>Delete - <?= htmlspecialchars($reservationId['name']) ?></h2>
<form action="" method="post">
    <p>
        Weet u zeker dat u het account"<?=htmlspecialchars( $reservationId['name']) ?>" wilt verwijderen?
    </p>
    <input type="hidden" name="id" value="<?=htmlspecialchars( $reservationId['ID']) ?>"/>
    <input type="submit" name="submit" value="Verwijderen"/>
</form>

</body>
</html>