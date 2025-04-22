<?php
require_once "../config/connexion.php"; // Inclure la connexion

// Fonction pour récupérer toutes les années scolaires
function getAllAnneesScolaires()
{
    global $pdo;
    $sql = "SELECT * FROM Annee_Scolaire";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAnneesScolaires(int $id)
{
    global $pdo;
    
    $sql = "SELECT lib_as FROM Annee_Scolaire WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);

    return $stmt->fetch(PDO::FETCH_ASSOC) ?: null; // Retourne null si aucun résultat
}
// Fonction pour ajouter une année scolaire
function addAnneeScolaire($libelle)
{
    global $pdo;
    $sql = "INSERT INTO Annee_Scolaire (lib_as) VALUES (:libelle)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([':libelle' => $libelle]);
}

// Fonction pour supprimer une année scolaire
function deleteAnneeScolaire($id)
{
    global $pdo;
    $sql = "DELETE FROM Annee_Scolaire WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([':id' => $id]);
}
?>
