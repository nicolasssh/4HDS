<?php
require('db_connection.php');
if ($conn->query('UPDATE users SET nom = "'.$_POST['nom'].'", prenom = "'.$_POST['prenom'].'" WHERE token = "'.$_GET['token'].'"')) {
    header('Location: ../index.php?token='.$_GET['token']);
}
?>