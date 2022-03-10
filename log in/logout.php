<?php

session_start();
session_destroy();
//als je de uitlog knop druk wordt jeterug gezet op de inlog pagina
header('Location: inlog.php');
exit;


