<?php
require_once "../config/connexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_qcm = intval($_POST['id_qcm']);
    $titre = $_POST['titre'];
    $filiere = $_POST['filiere'];
    $niveau = $_POST['niveau'];

    // Mettre à jour le QCM
    $sql = "UPDATE qcm SET niveau = :niveau, titre = :titre, filiere = :filiere WHERE id_qcm = :id_qcm";
  $stmt = $pdo->prepare($sql);
   $stmt->execute([
    'niveau' => $niveau,
    'titre' => $titre,
    'filiere' => $filiere,
    'id_qcm' => $id_qcm
]);

    // Mettre à jour les questions et réponses
    foreach ($_POST['questions'] as $id_question => $texte_question) {
        $sql = "UPDATE questions SET texte_question = :texte_question WHERE id = :id_question";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'texte_question' => htmlspecialchars($texte_question),
            'id_question' => intval($id_question)
        ]);
        foreach ($_POST['reponses'][$id_question] as $id_reponse => $texte_reponse) {
            $est_correct = (isset($_POST['correct'][$id_question]) && $_POST['correct'][$id_question] == $id_reponse) ? 1 : 0;
    
            $sql = "UPDATE reponses SET texte_reponse = :texte_reponse, est_correct = :est_correct WHERE id = :id_reponse";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'texte_reponse' => htmlspecialchars($texte_reponse),
                'est_correct'   => intval($est_correct),
                'id_reponse'    => intval($id_reponse)
            ]);
        }
    }
    header("Location: ../pages/ListerQCM.php?message=QCM modifié avec succès");
    exit;
}
?>