<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convertir en Devise</title>

    <style>
        label {
           
            font-family: arial;
            font-size: 25px;
            color: #00353F;
            text-shadow: 1px 2px 1px black;
        }

        body {



            font-family: arial;
            background-image: url('https://cdn.pixabay.com/photo/2016/11/14/22/18/beach-1824855_1280.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            text-align: center;
            height: 550px;

        }

        p {
            color: #00353F;
            text-shadow: 1px 2px 1px black;
            text-align: center;
            font-size: 30px;
            font-weight: bold;

        }

        h3 {
            color: #03EA68;
            text-shadow: 3px 2px 2px black;
            text-align: center;
            font-size: 30px;
        }



        h2 {
            font-size: 60px;
            text-align: center;
            margin-top: 5%;
            color: #03EA68;
            text-shadow: 3px 3px 3px black;
        }

        form {
            text-align: center;

            margin-top: 5%;

        }

        fieldset {
            margin-left: auto;
            margin-right: auto;
            border-radius: 10px;
        }

        .line {
            width: 50%;
            margin: 0 auto;
            border-top: 2px solid #04BBFF;
            margin-top: 40px;
            margin-bottom: 40px;
            box-shadow: 1px 1px 1px black;

        }

        input {
            border: none;
            border-radius: 10px;
            padding: 20px;
            width: 30%;
            background-color: #ffff;
            height: 10px;
            box-shadow: 2px 2px 3px black;
        }

        button {
            color: white;
            border-radius: 10px;
            background-color: #00353F;
            box-shadow: 2px 2px 3px black;
            width: 100px;
            height: 40px;
            text-shadow: 2px 2px 1px black;
            font-weight: bold;
            border: none;
        }
    </style>

</head>

<body>


    <h2>Convertir en Devise</h2>



    <div class="line"></div>
    <form action="./exercicechange.php/convert.php" method="post">
        <label for="amount"><strong>(Euros) :<strong></label>
        <input type="text" id="amount" name="amount" required><br><br><br>

        <label for="currency"><strong>Devise de destination :</strong></label>
        <select id="currency" name="currency" required>
            <option value="GBP">Livres sterling (GBP)</option>
            <!-- Ajoutez d'autres devises selon vos besoins -->
        </select>

        <button type="submit">Convertir</button>
    </form>

</body>


</html>





<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifiez si les champs sont définis et non vides
    if (isset($_POST["amount"]) && isset($_POST["currency"]) && !empty($_POST["amount"]) && !empty($_POST["currency"])) {
        // Obtenez les valeurs saisies dans les champs
        $amount = floatval($_POST["amount"]);
        $currency = $_POST["currency"];

        // Votre clé d'API Open Exchange Rates
        $api_key = '4ed9bd9ace8fe952036e94b2';

        // URL de l'API Open Exchange Rates
        $api_url = "https://v6.exchangerate-api.com/v6/{$api_key}/latest/EUR";

        // Obtenez les données de l'API
        $api_data = file_get_contents($api_url);

        // Vérifiez si la requête a réussi
        if ($api_data !== false) {
            // Convertissez les données JSON en tableau associatif
            $exchange_data = json_decode($api_data, true);

            // Vérifiez si la conversion existe pour la devise que vous utilisez
            if (isset($exchange_data['conversion_rates'][$currency])) {
                // Obtenez le taux de change pour la devise
                $taux_de_change = $exchange_data['conversion_rates'][$currency];

                // Effectuez la conversion
                $converted_amount = $amount * $taux_de_change;


                echo "<h3>Résultat de la conversion :</h3>";
                echo "<p>Le montant en $currency est : $converted_amount $currency</p>";
            } else {
                echo "<p>Impossible de trouver le taux de change pour la devise spécifiée.</p>";
            }
        } else {
            echo "<p>Erreur lors de la récupération des données de l'API.</p>";
        }
    } else {
        // Affichez un message d'erreur si les champs sont vides
        echo "<p>Veuillez saisir un montant et sélectionner une devise valide.</p>";
    }
}
?><div class="line"></div>