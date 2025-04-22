<?php
require_once "../config/connexion.php";
?>
<?php
// Récupérer toutes les filières
$sql_filiere = "SELECT id, abr_fil FROM filiere order by id";
$stmt_filiere = $pdo->prepare($sql_filiere);
$stmt_filiere->execute();
$filieres = $stmt_filiere->fetchAll(PDO::FETCH_ASSOC);
// Récupérer tous les niveaux
$sql_niveau = "SELECT id, lib_niv FROM niveau"; 
$stmt_niveau = $pdo->prepare($sql_niveau);
$stmt_niveau->execute();
$niveaux = $stmt_niveau->fetchAll(PDO::FETCH_ASSOC);

$id = intval($_GET['id']); // Sécurisation

// Récupérer les infos du QCM
$sql = "SELECT * FROM qcm WHERE id_qcm = $id";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$qcm = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$qcm) {
    die("QCM introuvable.");
}

$sql2 = "SELECT * FROM questions WHERE id_qcm = $id";
$stmt2 = $pdo->prepare($sql2);
$stmt2->execute();
$questions = $stmt2->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les réponses pour chaque question
$reponses = [];
foreach ($questions as $question) {
    $sql3 = "SELECT * FROM reponses WHERE question_id = $question[id]";
    $stmt3 = $pdo->prepare($sql3);
    $stmt3->execute();
    $reponses[$question['id']] = $stmt3->fetchAll(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/Modifier_QCM.css">
    <title>Modifier QCM</title>
    <style>
 body {
    font-family: Arial, sans-serif;
   
    background-color:rgb(173, 221, 177);
}

form {
    max-width: 100%;
    margin: 10px;
    background: rgb(247, 243, 243);
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}
.info-box {
    background:rgb(191, 226, 163);
    padding: 15px;
    margin-top: 10px;
    border-left: 5px solidrgb(0, 255, 85);
    border-radius: 5px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
h2 {
    text-align: center;
    color: rgb(21, 68, 224);;
    margin-bottom: 20px;
    font-weight: bold;
}
h1 {
    text-align: center;
    color:rgb(21, 68, 224);
    margin-bottom: 20px;
    font-weight: bold;
}
.info-box label {
    font-weight: bold;
    font-size: 16px;
    color: #555;
    display: block;
    margin: 8px;
}
.info-box input[type="text"] {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}
.info-box select {
    width: 90%;
    padding: 12px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background: white;
    box-sizing: border-box;
}
.question {
    border: 1px solid #ddd;
    margin: 10px;
    background:rgb(231, 247, 227);
    padding: 15px;
    border-radius: 8px;
    border: 1px solid #ccc;
    width: 90%; 
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
}
.question input[type="text"] {
    width: 97%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-bottom: 10px;
    margin: 10px;
}
.question label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
}
.reponses {
    margin-left: 20px;
    display: flex;
    align-items: center;
    width: 70%;
}
.reponses input[type="text"] {
    flex-grow: 1;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-right: 10px;
    margin-bottom: 5px;
}

.reponses input[type="radio"] {
    transform: scale(1.3);
    cursor: pointer;
    margin-right: 10px;
}
.btn {
    display: flex;
    justify-content: center;
}
.btn button{
    background-color: #28a745;
    color: white;
    border: none;
    width: 500px;
    padding: 10px;
    margin-top: 20px;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
}

button:hover {
    background-color: #218838;
}
    </style>
</head>
<body>

<h1>Modifier le QCM</h1>

<form method="POST" action="../scripts/ModiffierQCM.php">
   <input type="hidden" name="id_qcm" value="<?= $qcm['id_qcm'] ?>">
   <div class="info-box">
    <label>Titre</label>
    <input type="text" name="titre" value="<?= htmlspecialchars($qcm['titre']) ?>" required>

    <label>Filière</label>
    <select name="filiere" required>
    <?php foreach ($filieres as $filiere): ?>
        <option value="<?= htmlspecialchars($filiere['id']) ?>" <?= ($qcm['filiere'] == $filiere['id']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($filiere['abr_fil']) ?>
        </option>
      <?php endforeach; ?>
    </select>

    <label>Niveau</label>
    <select name="niveau" required>
       <?php foreach ($niveaux as $niveau): ?>
          <option value="<?= $niveau['id'] ?>" <?= ($qcm['niveau'] == $niveau['id']) ? 'selected' : '' ?>>
              <?= htmlspecialchars($niveau['lib_niv']) ?>
        </option>
      <?php endforeach; ?>
   </select>
    </div>
    <h2>Questions et Réponses :</h2>
    <?php $i=1; ?>
    <?php foreach ($questions as $question): ?>
        <div class="question">
            <label>Question : <?php echo $i; ?></label>
            <input type="text" name="questions[<?= $question['id'] ?>]" value="<?= htmlspecialchars_decode($question['texte_question']) ?>" required>
        </div>

        <ul>
            <?php foreach ($reponses[$question['id']] as $reponse): ?>
                <li class="reponses">
                    <input type="text" name="reponses[<?= $question['id'] ?>][<?= $reponse['id'] ?>]" value="<?= htmlspecialchars_decode($reponse['texte_reponse']) ?>" required>
                    <input type="radio" name="correct[<?= $question['id'] ?>]" value="<?= $reponse['id'] ?>" <?= $reponse['est_correct'] ? 'checked' : '' ?>>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php $i++ ; ?>
    <?php endforeach; ?>
    <div class="btn">
    <button type="submit">Modifier</button>
    </div>
    
</form>

</body>
</html>