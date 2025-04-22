<?php
require_once "../config/connexion.php"; // Inclure la connexion

// Fonction pour récupérer toutes les filières
function getAllFilieres()
{
    global $pdo;
    $sql = "SELECT * FROM Filiere";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fonction pour récupérer filière par id
function getFiliere(int $id)
{
    global $pdo;
    
    $sql = "SELECT abr_fil FROM Filiere WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);

    $filiere = $stmt->fetch(PDO::FETCH_ASSOC);
    return $filiere ? $filiere['abr_fil'] : 'Filière inconnue'; 
}
// Fonction pour ajouter une filière
function addFiliere($libelle, $abbreviation)
{
    global $pdo;
    $sql = "INSERT INTO Filiere (lib_fil, abr_fil) VALUES (:libelle, :abbreviation)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':libelle' => $libelle,
        ':abbreviation' => $abbreviation
    ]);
}

// Fonction pour supprimer une filière
function deleteFiliere($id)
{
    global $pdo;
    $sql = "DELETE FROM Filiere WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([':id' => $id]);
}
?>
