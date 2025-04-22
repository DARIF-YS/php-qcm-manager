<?php
require_once "../config/connexion.php";
$id = intval($_GET['id']);
$sql = "SELECT * FROM qcm WHERE id_qcm = $id";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$qcm = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$qcm) {
    echo "QCM introuvable.";
    exit;
}

// 2️⃣ Récupérer les questions associées au QCM
$sql2 = "SELECT * FROM questions WHERE id_qcm = $id";
$stmt2 = $pdo->prepare($sql2);
$stmt2->execute();
$questions = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voir QCM</title>
    <style>
body {
    font-family: Arial, sans-serif;
    margin: 20px;
    background-color: #f4f4f4;
    color: #333;
    text-align: left;
}
p {
    margin: 5px 0;
    padding: 10px;
    font-size: 18px;
    font-weight: bold;
    color: #333;
}
strong {
    color: #007bff;
    font-size: 18px;
}

h1 {
    color: #007BFF;
    text-align: center;
    border-bottom: 2px solid #007bff;
    padding-bottom: 10px;
}
h2 {
    color: #28a745;
    border-bottom: 1px solid #28a745;
    padding-bottom: 5px;
    margin-top: 20px;
    text-align: center;
}
.question {
    font-weight: bold;
    margin-top: 20px;
    padding: 10px;
    background:rgb(182, 196, 133);
    border-radius: 5px;
    font-size: 18px;
}
ul {
    list-style: none;
    padding: 0;
}
.reponse {
    padding: 8px;
    margin: 5px 0;
    border-radius: 10px;
    transition: all 0.3s ease;
    background: #ffffff;
    border: 1px solid #ddd;
    display: flex;
    align-items: center;
    font-size: 16px
}
.reponse:hover {
    background: #ddd;
}
.correct {
    font-weight: bold;
}


    </style>
</head>
<body>
     <?php
     $s1= "SELECT lib_niv from niveau where id=$qcm[niveau]";
     $stm = $pdo->prepare($s1);
     $stm->execute();
     $niv = $stm->fetchColumn();
     $s2= "SELECT lib_fil from filiere where id=$qcm[filiere]";
     $stm = $pdo->prepare($s2);
     $stm->execute();
     $fil = $stm->fetchColumn();
     ?>
    <h1>QCM : <?= htmlspecialchars($qcm['titre']) ?></h1>
    <p><strong>Filière :</strong> <?= htmlspecialchars($fil) ?></p>
    <p><strong>Niveau :</strong> <?= htmlspecialchars($niv) ?></p>
    
    <h2>Questions :</h2>
    
    <?php foreach ($questions as $question): ?>
        <p class="question"><?= htmlspecialchars_decode($question['texte_question']) ?></p>
        
        <?php
        $sql3 = "SELECT * FROM reponses WHERE question_id = $question[id]";
        $stmt3 = $pdo->prepare($sql3);
        $stmt3->execute();
        $reponses = $stmt3->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <ul>
            <?php foreach ($reponses as $reponse): ?>
                <li class="reponse <?= $reponse['est_correct'] ? 'correct' : '' ?>">
                 <?= htmlspecialchars_decode($reponse['texte_reponse']) ?>
                 <?php if ($reponse['est_correct']): ?>
              <span class="icon">✔️</span>
                  <?php endif; ?>
              </li>
            <?php endforeach; ?>
        </ul>
    
    <?php endforeach; ?>

</body>
</html>