<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body
        {
            font-family: Arial, Helvetica, sans-serif;
            background-color: ghostwhite;
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
            margin-top: 100px;
        }
        header
        {
            text-align: center;
            background-color: blue;
            color: ghostwhite;
        }
    </style>
</head>

<body>
    <header>
        <h1> Inscription </h1>
    </header>
    <u1>
        <form action="inscription-from.php" method="POST"></form>
        <h3> Username : </h3>
        <input type="text" name="username"></input>
    </u1>

    <u2>
        <h3> Password : </h3>
        <input type="text" name="password"></input>
    </u2>
    
    <u3>
        <h3> E-mail : </h3>
        <form type="text" name="mail"></form>
    </u3>
    
    <input>
        <h3> Je m'inscris : </h3>
        <input type="button" name="je m'inscris"></input>
        <h6> J'accepte les conditions d'utilisation et la politique de confidentialité : </h6>
        <label for="oui">oui</label>
        <input type="checkbox" name="choice" id="oui"></input>
        <label for="non">non</label>
        <input type="checkbox" name="choise" id="non" ></input>
    </input>
</body>
