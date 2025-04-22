<?php
session_start();

// Vérifier si le score est bien passé en paramètre
if (!isset($_GET['score'])) {
    die("Erreur : Score non disponible.");
}

$score = (int) $_GET['score'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat du QCM</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .result-container {
            text-align: center;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
        .score {
            font-size: 2em;
            font-weight: bold;
            color: #007bff;
        }
        .message {
            font-size: 1.2em;
            margin-top: 10px;
        }
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <div class="result-container">
        <h1>Résultat du QCM</h1>
        <p>Votre score est :</p>
        <div class="score"><?= htmlspecialchars($score); ?></div>

        <div class="message">
            <?php
            if ($score >= 16) {
                echo "🎉 Excellent travail !";
            } elseif ($score >= 10) {
                echo "😊 Bon effort, continuez à vous améliorer !";
            } else {
                echo "😞 Il faut encore réviser.";
            }
            ?>
        </div>

        <a href="StartQCM.php" class="btn">Retour à l'accueil</a>
    </div>

</body>
</html>

