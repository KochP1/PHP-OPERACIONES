<?php
include 'conn.php';
session_start();

unset($_SESSION['sumas']);

session_destroy();

header('Location: index.php');
exit();
?>