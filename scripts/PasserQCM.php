<?php
require_once "../config/connexion.php";
?>
<?php
   session_start();
     if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
        $id_etudiant = $_SESSION['user_id'];
        $id_qcm = $_POST['id_qcm'];
        $score_total = 0;
    
        // Récupérer les bonnes réponses
        $sql = "SELECT question_id, id FROM reponses WHERE est_correct = 1";
        $stmt = $pdo->query($sql);
        $correct_answers = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $correct_answers[$row['question_id']] = $row['id'];
        }
        // Vérification des réponses
        foreach ($_POST as $key => $reponse_etudiant) {
            if (strpos($key, 'q') === 0) { // Vérifie que la clé commence par "q" 
                $id_question = substr($key, 1); // Récupère l'ID de la question 
    
                if (!empty($reponse_etudiant)) {
                    if (isset($correct_answers[$id_question]) && $reponse_etudiant == $correct_answers[$id_question]) {
                        $score_total += 2; // Bonne réponse
                    } else {
                        $score_total -= 1; // Mauvaise réponse
                    }
                } // Si aucune réponse, score = 0 (
            }
        }
        // Enregistrement du score
        $sql = "INSERT INTO score (id_etudiant, id_qcm, valeur) VALUES (:id_etudiant, :id_qcm, :valeur)
                ON DUPLICATE KEY UPDATE valeur = :valeur";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id_etudiant' => $id_etudiant,
            ':id_qcm' => $id_qcm,
            ':valeur' => $score_total
        ]);
        unset($_SESSION['debut_examen']);
    
        header("Location: ../pages/resultQCM.php?score=$score_total");
        exit();
    }
?>