<?php
include '../models/annScolaire.php';
include '../models/filiere.php';
include '../models/etudiant.php';
include '../models/niveau.php';

$message = null;
$niveaux = getAllNiveaux(); 
$filieres = getAllFilieres();
$annees = getAllAnneesScolaires();
$etudiants = getAllEtudiants();

$lang = $_GET['lang'] ?? 'fr'; // Par défaut, français

// Charger le fichier de langue correspondant
$lang_file = "../languages/" . basename($lang) . ".php";
if (file_exists($lang_file)) {
    include $lang_file;
} else {
    include "../languages/fr.php"; // Fallback sur le français
}

$etudiant = null;
if (!empty($_GET['data'])) {
    $data_json = urldecode($_GET['data']);
    $etudiant = json_decode($data_json, true) ?? null;
}
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Gestion Des Etudiants 🧑‍🎓</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/main.js"></script>
    <link rel="icon" type="image/png" href="../assets/icons/INSEA_logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>

    <?php 
        include '../includes/navAdmin.php'; 
    ?>

    <section>
        <div class="mt-5 pt-3 container">
                <?PHP include("../includes/formMStudent.php"); ?>
            <div class="mt-5 mb-4 mb-5 pb-4" >
                <?PHP include("../includes/tableStudent.php"); ?>
            </div>
        </div>
    </section>

    <?php 
        include '../includes/footer.php'; 
    ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script></body>

</body>
</html>
