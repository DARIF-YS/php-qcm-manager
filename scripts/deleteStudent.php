<?php
include("../config/connexion.php");
include("../models/etudiant.php");

// Suppression d'un étudiant si un ID est envoyé en POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $image_path = htmlspecialchars(getEtudian($id)['photo_etd']);
    $sql = "DELETE FROM etudiant WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    unlink($image_path);
    if($stmt->execute(['id' => $id] )){
            $message = "✅ Suppression bien fait" ;
    }else{
        $message = "⛔ Erreur de suppression" ;
    }
    // Redirection pour éviter la soumission multiple
    header("Location: ../pages/MStudent.php?message=$message");
    exit();
}

?>