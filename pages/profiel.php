<?php
/** @var mysqli $db */
require_once "database.php";

$query = "SELECT * FROM accounts";
$result = mysqli_query($db, $query) or die ('Error: ' . $query);

$accounts = [];
while ($row = mysqli_fetch_assoc($result)) {
    $accounts[] = $row;
}

mysqli_close($db);





?>
<!doctype html>
<html lang="en">
<head>
    <title>Account Edit</title>
    <meta charset="utf-8"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>
    <meta name="viewpart"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" type="text/css" href="style4.css"/>
</head>
<body>
<ul >
    <li><a href="index.php">OnlineBabyBeursReservatie.com</a></li>
    <li><a href="contact.php">Contact</a></li>

</ul>



<a href="profiel.php"></a>
<table>
    <tr>
        <th>E-mail</th>

        <th>Delete</th>
        <th>Edit</th>
    </tr>
    <?php
    foreach ($accounts as $index => $account){
    ?>
    <tr>
        <td><?= $account['email']?></td>



        <td><a href="delete2.php?index=<?=$account['id']?>">delete</a> </td>
        <td><a href="edit2.php?index=<?=$account['id']?>">edit</a> </td>
        <?php }?>
    </tr>
</table>
</div>
</body>
</html>
