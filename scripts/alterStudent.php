<?php
require_once "../config/connexion.php"; 
include '../models/etudiant.php';
$target_dir = "../uploads/";

// Vérifier si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Récupérer les données du formulaire
    $id_etudiant = $_POST['id_etudiant'];
    $annee_scolaire_id = $_POST['annee_scolaire_id'];
    $niveau_id = $_POST['niveau_id'];
    $filiere_id = $_POST['filiere_id'];
    $nom_etd = htmlspecialchars($_POST['nom_etd']);
    $prenom_etd = htmlspecialchars($_POST['prenom_etd']);
    $email_etd = htmlspecialchars($_POST['email_etd']);
    $sexe_etd = $_POST['sexe_etd'];
    $login_etd = htmlspecialchars($_POST['login_etd']);
    $mp_etd = $_POST['mp_etd']; // Mot de passe
    $matricule_etd = htmlspecialchars($_POST['matricule']);
    
    // Gestion de l'image
    $photo_etd = NULL; // Valeur par défaut (si pas de photo)
    if (isset($_FILES['photo_etd']) && $_FILES['photo_etd']['error'] == 0) {
        $ext = pathinfo($_FILES['photo_etd']['name'], PATHINFO_EXTENSION);
        $new_name =  $matricule_etd . '_' . $nom_etd . '_' . $prenom_etd . '.' . $ext;
        $photo_etd = $target_dir.$new_name;
        move_uploaded_file($_FILES['photo_etd']['tmp_name'], $photo_etd); // Déplacer l'image
    }

     // Ajouter l'étudiant à la base de données
    $message = updateEtudiant($id_etudiant,$nom_etd, $prenom_etd, $login_etd, $mp_etd, $email_etd, $matricule_etd, $sexe_etd, $photo_etd, $filiere_id, $niveau_id, $annee_scolaire_id);   
    header("Location: ../pages/MStudent.php?message=$message");
}

?>