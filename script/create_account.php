<?php
    require('db_connection.php');

//    function randomToken($car) {
//        $string = "";
//        $chaine = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
//        srand ( ( double ) microtime () * 1000000 );
//        for($i = 0; $i < $car; $i ++) {
//            $string .= $chaine [rand () % strlen ( $chaine )];
//        }
//        return $string;
//    }

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
//    $token = randomToken(32);
    $now = DateTime('NOW');

    var_dump($nom, $prenom, $now);
    die;

    $sql = "INSERT INTO users (nom, prenom, token, role, created_at, update_at) VALUES ('".$nom."', '".$prenom."', '".$token."', 0, '".$now."', '".$now."')";

    if ($conn->query($sql) === TRUE) {
        header('Location: ../login.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
?>