<?php
session_start();
// destroy session and redirect to login
$_SESSION = [];

session_destroy();
header('Location: /POO/views/login.php');
exit;
