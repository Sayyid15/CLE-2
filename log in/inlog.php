
<?php
session_start();
//Deze if statement werk als eerder was in gelogd mals het niet zo is moet je dan eerst registreren
if(isset($_SESSION['loggedInUser'])) {
    $login = true;
} else {
    $login = false;
}

/** @var mysqli $db */
//verbinding maken met de database
$db = mysqli_connect('localhost', 'root', '', 'onlinebabybeurs')
or die('Error: ' . mysqli_connect_error());

// De variabele email en password worden gemaakt tot een array met een post. En bij de variabele email is er een sql injectie
if (isset($_POST['submit'])) {
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


    if(empty($errors))
    {
       //Query opbouwen om de data op te halen van de email die eerder was ingevuld
        $query = "SELECT * FROM accounts WHERE email='$email'";
        //Query wordt uitgevoerd als de email uit de database gehaald is
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            //Als de juiste password is in gevuld wordt je ingelogd
            if (password_verify($password, $user['password'])) {
                $login = true;

                $_SESSION['loggedInUser'] = [
                    'email' => $user['email'],
                    'id' => $user['id']
                ];
            } else {
                //error dus je heb niet de juiste gegevens ingevuld
                $errors['loginFailed'] = 'De combinatie van email en wachtwoord is bij ons niet bekend';
            }
        } else {
            //error dus je heb niet de juiste gegevens ingevuld
            $errors['loginFailed'] = 'De combinatie van email en wachtwoord is bij ons niet bekend';
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
    <title>Login</title>
</head>
<body>
<ul >
    <li><a href="../pages/index.php">OnlineBabyBeursReservatie.com</a></li>
    <li><a href="../pages/contact.php">Contact</a></li>
    <li><a href="../pages/profiel.php">Profiel</a></li>
</ul>
<h2>Inloggen</h2>
<?php if ($login) { ?>
    <p>Je bent ingelogd!</p>
    <p><a href="logout.php">Uitloggen</a> / <a href="../pages/reserveren.php">Reseveer Hier!</a> /<a href="secure.php">reserveringen</a></p>
<?php } else { ?>
    <form action="" method="post">
        <div>
            <label for="email">Email</label>
            <input id="email" type="text" name="email" value="<?= $email ?? '' ?>"/>
            <span class="errors"><?= $errors['email'] ?? '' ?></span>
        </div>
        <div>
            <label for="password">Wachtwoord</label>
            <input id="password" type="password" name="password" />
            <span class="errors"><?= $errors['password'] ?? '' ?></span>
        </div>
        <div>
            <p class="errors"><?= $errors['loginFailed'] ?? '' ?></p>
            <input type="submit" name="submit" value="Login"/>
        </div>
    </form>
<?php } ?>
</body>
</html>
