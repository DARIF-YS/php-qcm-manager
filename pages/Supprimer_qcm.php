<?php
require_once "../config/connexion.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID QCM manquant.");
}

$id = intval($_GET['id']); 

// Supprimer les réponses associées
$sql1 = "DELETE FROM reponses WHERE question_id IN (SELECT id FROM questions WHERE id_qcm = $id)";
$stmt1 = $pdo->prepare($sql1);
$stmt1->execute();

// Supprimer les questions associées
$sql2 = "DELETE FROM questions WHERE id_qcm = $id";
$stmt2 = $pdo->prepare($sql2);
$stmt2->execute();

// Supprimer le QCM lui-même
$sql3 = "DELETE FROM qcm WHERE id_qcm = $id";
$stmt3 = $pdo->prepare($sql3);
$stmt3->execute();

// Redirection après suppression
header("Location: ListerQCM.php?message=QCM supprimé avec succès");
exit;
?>
