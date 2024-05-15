<!DOCTYPE html>
<lang="en">

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
        button
        {
            text-align: center;
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
        <input type="text" name="mail"></input><br><br><br><br>
    </u3>

    <u4>
        <button type="button" name="boutton-inscription">Je m'inscris</button>
        <h6> J'accepte les conditions d'utilisation et la politique de confidentialité : </h6>
        <label for="oui">oui :</label>
        <input type="checkbox" name="choice" id="oui"></input>
    </u4>
</body>