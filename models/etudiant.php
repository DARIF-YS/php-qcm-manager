<?php 
require_once "../config/connexion.php"; // Inclure la connexion

// Fonction pour récupérer tous les étudiants
function getAllEtudiants()
{
    global $pdo;
    $sql = "SELECT * FROM Etudiant";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getEtudian(int $id)
{
    global $pdo;
    $sql = "SELECT * FROM etudiant WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $etudiant = $stmt->fetch(PDO::FETCH_ASSOC);
    return $etudiant ? $etudiant : null; 
}

// Fonction pour ajouter un étudiant
function addEtudiant($nom_etd, $prenom_etd, $login, $password, $email_etd, $matricule_etd, $sexe_etd, $photo_etd, $filiere_id, $niveau_id, $annee_scolaire_id)
{
    global $pdo;
    $sql = "INSERT INTO Etudiant (nom_etd, prenom_etd, login, password, email_etd, matricule_etd, sexe_etd, photo_etd, filiere_id, niveau_id, annee_scolaire_id) 
            VALUES (:nom_etd, :prenom_etd, :login, :password, :email_etd, :matricule_etd, :sexe_etd, :photo_etd, :filiere_id, :niveau_id, :annee_scolaire_id)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':nom_etd' => $nom_etd,
        ':prenom_etd' => $prenom_etd,
        ':login' => $login,
        ':password' => password_hash($password, PASSWORD_BCRYPT), // Hash du mot de passe
        ':email_etd' => $email_etd,
        ':matricule_etd' => $matricule_etd,
        ':sexe_etd' => $sexe_etd,
        ':photo_etd' => $photo_etd,
        ':filiere_id' => $filiere_id,
        ':niveau_id' => $niveau_id,
        ':annee_scolaire_id' => $annee_scolaire_id
    ]);
}

// Fonction pour supprimer un étudiant
function deleteEtudiant($id)
{
    global $pdo;
    $sql = "DELETE FROM Etudiant WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([':id' => $id]);
}

// Fonction pour mettre à jour les informations d'un étudiant
function updateEtudiant($id, $nom_etd, $prenom_etd, $login, $password, $email_etd, $matricule_etd, $sexe_etd, $photo_etd, $filiere_id, $niveau_id, $annee_scolaire_id)
{
    global $pdo;

    // Vérifier l'unicité de l'email, du matricule et du login (sauf pour l'étudiant en cours)
    $checkSql = "SELECT id FROM Etudiant WHERE (email_etd = :email OR matricule_etd = :matricule OR login = :login) AND id != :id";
    $checkStmt = $pdo->prepare($checkSql);
    $checkStmt->execute([
        ':email' => $email_etd,
        ':matricule' => $matricule_etd,
        ':login' => $login,
        ':id' => $id
    ]);

    if ($checkStmt->fetch()) {
        return "Erreur : Email, matricule ou login déjà utilisé.";
    }

    // Début de la requête SQL
    $sql = "UPDATE Etudiant SET nom_etd = :nom_etd, prenom_etd = :prenom_etd, login = :login, 
            email_etd = :email_etd, matricule_etd = :matricule_etd, sexe_etd = :sexe_etd, 
            filiere_id = :filiere_id, niveau_id = :niveau_id, annee_scolaire_id = :annee_scolaire_id";

    // Tableau des paramètres
    $params = [
        ':id' => $id,
        ':nom_etd' => $nom_etd,
        ':prenom_etd' => $prenom_etd,
        ':login' => $login,
        ':email_etd' => $email_etd,
        ':matricule_etd' => $matricule_etd,
        ':sexe_etd' => $sexe_etd,
        ':filiere_id' => $filiere_id,
        ':niveau_id' => $niveau_id,
        ':annee_scolaire_id' => $annee_scolaire_id
    ];

    // Ajout du mot de passe seulement s'il est fourni
    if (!empty($password)) {
        $sql .= ", password = :password";
        $params[':password'] = password_hash($password, PASSWORD_BCRYPT);
    }

    // Ajout de la photo seulement si elle est fournie
    if (!empty($photo_etd)) {
        $sql .= ", photo_etd = :photo_etd";
        $params[':photo_etd'] = $photo_etd;
    }

    // Ajout de la condition WHERE
    $sql .= " WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    if ($stmt->execute($params)) {
        $message = urlencode("Mise à jour réussie.");
    } else {
        $message = urlencode("Erreur lors de la mise à jour.");
    }
    return $message;
}

?>
