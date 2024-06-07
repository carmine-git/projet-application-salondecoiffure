<?php


$host="localhost";
$db_name="serveur_database";
$user="root";
$pass="";

try
{
    $db = new PDO("mysql:host=" . $host . ";dbname=" . $db_name, $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connect > Ok!";
}
catch(PDOException $e)
{
    echo $e;
}


