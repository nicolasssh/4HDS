<?php
require('db_connection.php');
if ($conn->query('DELETE FROM users WHERE token = "'.$_GET['token'].'"')) {
    header('Location: ../login.php');
}
?>