<?php
require_once "../config/connexion.php"; // Inclure la connexion

// Fonction pour récupérer tous les niveaux
function getAllNiveaux()
{
    global $pdo;
    $sql = "SELECT * FROM Niveau";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getNiveau(int $id)
{
    global $pdo;
    
    $sql = "SELECT abr_niv FROM Niveau WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);

    return $stmt->fetch(PDO::FETCH_ASSOC) ?: null; // Retourne null si aucun résultat
}


// Fonction pour ajouter un niveau
function addNiveau($libelle, $abbreviation)
{
    global $pdo;
    $sql = "INSERT INTO Niveau (lib_niv, abr_niv) VALUES (:libelle, :abbreviation)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':libelle' => $libelle,
        ':abbreviation' => $abbreviation
    ]);
}

// Fonction pour supprimer un niveau
function deleteNiveau($id)
{
    global $pdo;
    $sql = "DELETE FROM Niveau WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([':id' => $id]);
}
?>
