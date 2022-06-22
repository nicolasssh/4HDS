<?php
    include './db_connection.php';
    include '../classes/User.php';

//    function randomToken($car) {
//        $string = "";
//        $chaine = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
//        srand ( ( double ) microtime () * 1000000 );
//        for($i = 0; $i < $car; $i ++) {
//            $string .= $chaine [rand () % strlen ( $chaine )];
//        }
//        return $string;
//    }

    if (isset($_POST['name']) && !empty($_POST['name'])) {
        if (isset($_POST['firstname']) && !empty($_POST['firstname'])) {
            if (isset($_POST['role']) && !empty($_POST['role'])) {

                $new_user = new User($_POST['name'], $_POST['firstname'], null, $_POST['role'], DateTime('NOW'), DateTime('NOW'));
                var_dump($new_user);
                die;

            }
        }
    }
?>