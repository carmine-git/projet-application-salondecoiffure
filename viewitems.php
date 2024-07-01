<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="viewitems.css">
</head>

<body>
    <?php

    session_start();

    ?>
    <form action="payment.php" method="post">
        <div class="summary-container">
            <div class="container-content">
                <h2>Coupe</h2>
                <p><?php echo $_SESSION['prestations_client']['coupe_client'] ?></p>
                <h2>prix</h2>
                <p><?php echo $_SESSION['prestations_client']['prix_tot'] . "€" ?></p>
                <button>payer</button>
            </div>
        </div>
    </form>
</body>

</html>