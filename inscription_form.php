<!DOCTYPE html>
<lang="en">
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
        img 
        {
            height: 30px;
            cursor: pointer;
            vertical-align: middle;
        }
    </style>
</head>


    <header>
        <h1> Inscription </h1>
    </header>
    <u1>
        <form action="inscription-from.php" method="POST"></form>
        <h3> Identifiant : </h3>
        <input type="text" name="username"></input>
    </u1>

    <u2>
        <h3> Mot de passe : </h3>
        <input type="password" id="pass" name="password"></input>
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQQOqxAm4aOSdNH7YKYXgIwnyNd6fJhEJMf1R5GVOss4Ki18uijwNtfzex_NBgrg1owlGM&usqp=CAU" id="eye" onClick="changer()"></img>
        <script>
            let e=true;
            function changer()
            {
                if(e)
                {
                    document.getElementById("pass").setAttribute("type", "text");
                    document.getElementById("eye").src="https://www.svgrepo.com/show/353106/eye.svg";
                    e=false;
                }
                else
                {
                    document.getElementById("pass").setAttribute("type", "password");
                    document.getElementById("eye").src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQQOqxAm4aOSdNH7YKYXgIwnyNd6fJhEJMf1R5GVOss4Ki18uijwNtfzex_NBgrg1owlGM&usqp=CAU";
                    e=false;
                }
            }
        </script>
    </u2>

    <u5>
        <h3> Confirmer le mot de passe : </h3>
        <input type="password" id="password" name="confirmpassword"></input>
    </u5>
    
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