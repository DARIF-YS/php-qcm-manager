<?php
$host = 'localhost'; 
$dbname = 'cosDB'; 
$username = 'root'; 
$password = ''; 

try {
    // Création de l'objet PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Configuration des options PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    #echo "Connexion réussie !";
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
