<?php
  require_once "../config/connexion.php";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST["titre"];
    $filiere = $_POST["filiere"];
    $niveau = $_POST["niveau"];
    $questions = $_POST["questions"];
    $reponses = $_POST["reponses"];
    $bonnes_reponses = $_POST["bonne_reponse"];
  
        // Insérer le QCM
        $stmt = $pdo->prepare("INSERT INTO qcm (niveau, titre, filiere) VALUES (?, ?, ?)");
        $stmt->execute([$niveau, $titre, $filiere]);
        $id_qcm = $pdo->lastInsertId();
  
        // Insérer les questions 
        foreach ($questions as $index => $texte_question) {
            $stmt = $pdo->prepare("INSERT INTO questions (id_qcm, texte_question) VALUES (?, ?)");
            $stmt->execute([$id_qcm, $texte_question]);
            $id_question = $pdo->lastInsertId();
  
            // Insérer les réponses
           
            foreach ($reponses[$index] as $key => $texte_reponse) {
                $est_correct = ($key + 1 == $bonnes_reponses[$index]) ? 1 : 0;
                $stmt = $pdo->prepare("INSERT INTO reponses (question_id, texte_reponse, est_correct) VALUES (?, ?, ?)");
                $stmt->execute([$id_question, $texte_reponse, $est_correct]);
            }
        }
        
       header("Location: ../pages/AjoutQCM.php?message=$message");
      }
?>