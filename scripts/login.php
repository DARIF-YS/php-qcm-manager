<?php
session_start();

include '../config/connexion.php'; 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (empty($login) || empty($password) || empty($role)) {
        $message = "Tous les champs sont obligatoires.";
        header("Location: ../index.php?message=" . urlencode($message));
        exit;
    }

    // Vérification du rôle pour éviter toute injection SQL
    if ($role !== 'admin' && $role !== 'etudiant') {
        $message = "Rôle invalide.";
        header("Location: ../index.php?message=" . urlencode($message));
        exit;
    }

    // Déterminer la table selon le rôle
    $table = ($role === 'admin') ? 'admin' : 'etudiant';

    try {
        // Requête préparée pour éviter les injections SQL
        $stmt = $pdo->prepare("SELECT * FROM $table WHERE login = :login");
        $stmt->execute(['login' => $login]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Redirection après connexion réussie
            if ($role === 'admin') {
                header("Location: ../pages/MStudent.php");
            } else {
                $_SESSION['user_id'] = $user['id']; 
                header("Location: ../pages/StartQCM.php");
            }
            exit;
        } else {
            $message = "Identifiants incorrects.";
            header("Location: ../index.php?message=" . urlencode($message));
            exit;
        }
    } catch (PDOException $e) {
        $message = "Erreur lors de la connexion.";
        header("Location: ../index.php?message=" . urlencode($message));
        exit;
    }
}
?>
