<?php
include 'conn.php';
session_start();

unset($_SESSION['sumas']);

//session_destroy();
session_write_close();

header('Location: index.php');
exit();
?>