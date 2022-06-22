<?php
    include('../classes/User.php');
    require('./db_connection.php');
    if (isset($_POST['nom']) && !empty($_POST['nom'])) {
        if (isset($_POST['prenom']) && !empty($_POST['prenom'])) {
            $query = 'SELECT * FROM users WHERE prenom = "'.$_POST['prenom'].'" AND nom = "'.$_POST['nom'].'"';
            $data = $conn->query($query);
            $userData = mysqli_fetch_array($data);
            if (mysqli_num_rows($data) > 0) {
                header('Location: ../index.php?token='.$userData['token']);
                return true;
            } else {
                header('Location: ../login.php');
                return false;
            }
        }
    }
?>