<?php

//$db = mysqli_connect('localhost', 'root', 'your_password', 'peluqueria_mvc');
$db = mysqli_connect('localhost', 'root', 'root', 'mayorista');
$db->set_charset("utf8");

if (!$db) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "errno de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}
