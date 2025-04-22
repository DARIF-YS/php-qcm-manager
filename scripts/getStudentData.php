<?php
include("../config/connexion.php");
include("../models/etudiant.php");

// Modification d'un étudiant si un ID est envoyé en POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $etudiant = getEtudian($id); 

    // Vérification que l'étudiant existe
    if (!$etudiant) {
        http_response_code(400); // Indique une requête invalide
        echo json_encode(["error" => "Étudiant introuvable."]);
        exit();
    }

    $dictionnaire_etudiant = [
        "id" => $etudiant["id"],
        "nom" => $etudiant["nom_etd"],
        "prenom" => $etudiant["prenom_etd"],
        "login" => $etudiant["login"],
        "email" => $etudiant["email_etd"],
        "matricule" => $etudiant["matricule_etd"],
        "sexe" => $etudiant["sexe_etd"],
        "photo" => $etudiant["photo_etd"],
        "filiere_id" => $etudiant["filiere_id"],
        "niveau_id" =>  $etudiant["niveau_id"],
        "annee_scolaire_id" => $etudiant["annee_scolaire_id"]
    ];

    // Convertir le dictionnaire en JSON et l'encoder pour l'URL
    $data_json = rawurlencode(json_encode($dictionnaire_etudiant));

    header("Location: ../pages/MStudent.php?data=" . $data_json);
    exit();
}
?>
