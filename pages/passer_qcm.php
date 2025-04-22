<?php
require_once "../config/connexion.php";
?>
<?php
session_start();
$temps_total = 60*60; 

if (!isset($_SESSION['debut_examen'])) {
    $_SESSION['debut_examen'] = time(); 
}

$temps_ecoule = time() - $_SESSION['debut_examen']; // Temps écoulé depuis le début
$temps_restant = max($temps_total - $temps_ecoule, 0); // Empêche un temps négatif

?>
<?php
$id_qcm = isset($_GET['id']) ? trim($_GET['id']) : null;
 $sql = "SELECT q.id AS question_id, q.texte_question, r.id AS reponse_id, r.texte_reponse
 FROM questions q
 JOIN reponses r ON q.id = r.question_id
 WHERE q.id_qcm = :id_qcm";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id_qcm' => $id_qcm]);
$questions = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $question_id = $row['question_id'];

    if (!isset($questions[$question_id])) {
        $questions[$question_id] = [
            'question' => $row['texte_question'],
            'reponses' => [] 
        ];
    }
    if (!empty($row['reponse_id'])) {
        $questions[$question_id]['reponses'][] = [
            'id_reponse' => $row['reponse_id'],
            'texte' => $row['texte_reponse']
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Examen</title>
    <link rel="stylesheet" href="../assets/css/PasserQCM.css">
    <style>
.timer {
    text-align: center;
    font-size: 20px;
    font-weight: bold;
    color: red;
    margin-bottom: 20px;
    }
    </style>
</head>
<body>
<div class="exam-container">
    <h1 class="title">Examen</h1>
    <div class="timer">Temps restant : <strong id="timer"><?= gmdate("i:s", $temps_restant); ?></strong></div>
    <form id="qcm-form" method="POST" action="../scripts/PasserQCM.php">
    <input type="hidden" name="id_qcm" value="<?= htmlspecialchars($id_qcm); ?>">
        <?php $i=1;
               foreach ($questions as $id_question => $data) : ?>
            <fieldset>
            <div class="question">
                <legend>question <?php echo $i." : ".htmlspecialchars($data['question']); ?></legend>
            </div>
            <div class="answers">
                <?php foreach ($data['reponses'] as $rep) : ?>
                    <label>
                        <input type="radio" name="q<?= $id_question; ?>" value="<?= $rep['id_reponse']; ?>">
                        <?= htmlspecialchars($rep['texte']); ?>
                    </label><br>
                <?php endforeach; ?>
            </div>
            </fieldset>
        <?php endforeach; ?>
        <button type="submit" class="btn-submit">valider</button>
    </form>
</div>
<script>
let tempsRestant = <?= $temps_restant; ?>;
function mettreAJourTimer() {
    let minutes = Math.floor(tempsRestant / 60);
    let secondes = tempsRestant % 60;
    document.getElementById("timer").innerText = `${minutes}:${secondes < 10 ? '0' : ''}${secondes}`;

    if (tempsRestant <= 0) {
        alert("Temps écoulé ! Votre examen sera soumis.");
        document.getElementById("qcm-form").submit();
    } else {
        tempsRestant--;
        setTimeout(mettreAJourTimer, 1000);
    }
}

mettreAJourTimer();
</script>

</body>
</html>