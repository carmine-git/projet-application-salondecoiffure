<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Prestations Homme</title>
    <link rel="stylesheet" href="homme.css" />
</head>

<body>
    <form action="homme_form.php" method="post">
        <h1 class="titre">Choix de la prestation :</h1>
        <?php
        session_start();

        $feature_prices = array(
            "coupe" => array(
                "degrade" => 6,
                "mi-long" => 8,
                "long" => 10,
                "mi-court" => 12,
                "court" => 14,
            ),
            "couleur" => array(
                "brun" => 6,
                "blond" => 8,
                "chatain" => 10,
                "roux" => 12,
                "noir" => 14,
            )

        );

        $_SESSION['prestations'] = $feature_prices;
        ?>

        <div class="container">
            <fieldset>
                <legend>Choisissez votre coupe</legend>
                <div>
                    <input type="radio" id="aucun" name="coupe" value="aucun" checked />
                    <label for="aucun">Aucun</label>
                </div>
                <div>
                    <input type="radio" id="degrade" name="coupe" value="degrade" checked />
                    <label for="degrade">Dégradé</label>
                </div>
                <div>
                    <input type="radio" id="mi-long" name="coupe" value="mi-long" checked />
                    <label for="mi-long">Mi-Long</label>
                </div>
                <div>
                    <input type="radio" id="long" name="coupe" value="long" checked />
                    <label for="long">Long</label>
                </div>
                <div>
                    <input type="radio" id="mi-court" name="coupe" value="mi-court" checked />
                    <label for="mi-court">Mi-Court</label>
                </div>
                <div>
                    <input type="radio" id="court" name="coupe" value="mi-court" checked />
                    <label for="court">Court</label>
                </div>
            </fieldset>

            <fieldset>
                <legend>Choisissez votre couleur</legend>
                <div>
                    <input type="radio" id="aucun" name="couleur" value="aucun" checked />
                    <label for="aucun">Aucun</label>
                </div>
                <div>
                    <input type="radio" id="brun" name="couleur" value="brun" checked />
                    <label for="brun">Brun</label>
                </div>
                <div>
                    <input type="radio" id="blond" name="couleur" value="blond" checked />
                    <label for="blond">Blond</label>
                </div>
                <div>
                    <input type="radio" id="chatain" name="couleur" value="chatain" checked />
                    <label for="chatain">chatain</label>
                </div>
                <div>
                    <input type="radio" id="roux" name="couleur" value="roux" checked />
                    <label for="roux">Roux</label>
                </div>
                <div>
                    <input type="radio" id="noir" name="couleur" value="noir" checked />
                    <label for="noir">Noir</label>
                </div>
            </fieldset>

        </div><br><br><br>
        <h3 class="prix">Prix de la prestation :</h3>
        <input type="submit" class="confirm-button"></input>
    </form>
</body>

</html>