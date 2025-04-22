<?php
$lang = $_GET['lang'] ?? 'ar'; // Par défaut, français
// Charger le fichier de langue correspondant
$lang_file = "../languages/" . basename($lang) . ".php";
if (file_exists($lang_file)) {
    include $lang_file;
} else {
    include "../languages/fr.php"; // Fallback sur le français
}
require_once "../config/connexion.php";
$sql1 = "SELECT id_qcm, titre, filiere, niveau FROM qcm";
$stmt = $pdo->prepare($sql1);
$stmt->execute();
$qcms = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des QCMs</title> 
    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background-color: #f8f9fa;
    padding: 20px;
}

h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
}

thead {
    background-color:rgb(61, 175, 122);
    color: white;
    text-align: center;
}

th, td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: center;
}


tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}

a {
    text-decoration: none;
    padding: 6px 14px;
    border-radius: 4px;
    font-size: 14px;
}

a[href^="voir_qcm.php"] {
    background-color: #28a745;
    color: white;
}
a[href^="Modifier_qcm.php"] {
    background-color:rgb(16, 86, 218);
    color: white;
}

a[href^="Supprimer_qcm.php"] {
    background-color: #dc3545;
    color: white;
}

a:hover {
    opacity: 0.8;
}
    </style>
</head>
<body>
<?php 
        include '../includes/navAdmin.php'; 
    ?>

</div>

    <h2>Liste des QCMs</h2>
    <table border="1">
        <thead>
            <tr>
                <th><?= $translations['id'] ?></th>
                <th><?= $translations['titre'] ?></th>
                <th><?= $translations['filiere'] ?></th>
                <th><?= $translations['niveau_scolaire'] ?></th>
                <th><?= $translations['actions'] ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($qcms as $qcm): 
                 $sql2= "SELECT lib_niv from niveau where id=$qcm[niveau]";
                 $stm = $pdo->prepare($sql2);
                 $stm->execute();
                 $niv = $stm->fetchColumn();
                 $sql3= "SELECT abr_fil from filiere where id=$qcm[filiere]";
                 $stm = $pdo->prepare($sql3);
                 $stm->execute();
                 $fil = $stm->fetchColumn();
                 
                
                ?>
                
                <tr>
                    <td><?= htmlspecialchars($qcm['id_qcm']) ?></td>
                    <td><?= htmlspecialchars($qcm['titre']) ?></td>
                    <td><?= htmlspecialchars($fil) ?></td>
                    <td><?= htmlspecialchars($niv) ?></td>
                    <td>
                        <a href="voir_qcm.php?id=<?= $qcm['id_qcm'] ?>"><?= $translations['voir'] ?></a>
                        <a href="Modifier_qcm.php?id=<?= $qcm['id_qcm'] ?>"><?= $translations['modifier'] ?></a>
                        <a href="Supprimer_qcm.php?id=<?= $qcm['id_qcm'] ?>" onclick="return confirm('Voulez-vous vraiment supprimer ce QCM ?')"><?= $translations['supprimer'] ?></a>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
