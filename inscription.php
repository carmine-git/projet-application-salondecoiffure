<?php
if ($_SERVER["REQUEST_METHOD"]== "POST")
{
    var_dump($_POST);
    $username = $_POST["username"];
    $password = $_POST["password"];
    $mail = $_POST["mail"];

    /*$valid_username = "user";
    $valid_password = "password";
    $valid_mail = "mail";

    if($username == $valid_username && $password == $valid_password && $mail == $valid_mail)
    {
        header("Localisation: dashbord.php");
        exit();
    }
    else
    {
        echo "<script>alert('Invalid username or password or mail');</script>";
    }*/

}
