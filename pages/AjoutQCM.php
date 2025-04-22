<?PHP 

$lang = $_GET['lang'] ?? 'fr'; // Par défaut, français
// Charger le fichier de langue correspondant
$lang_file = "../languages/" . basename($lang) . ".php";
if (file_exists($lang_file)) {
    include $lang_file;
} else {
    include "../languages/fr.php"; 
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>📖 Gestion des QCM</title>
    <link rel="icon" type="image/png" href="../assets/icons/INSEA_logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/GQCM.css">
    <style>
body {
        font-family: Arial, sans-serif;
        margin: 60px;
        padding: 20px;
}  
h2 {
    text-align: center;
    color: #333;
    font-size: 30px;
    margin-bottom: 15px;
}
.table-informat {
    width: 70%;
    margin: 30px auto;
    border-collapse: separate;
    border-spacing: 10px;
    background:rgb(238, 232, 232);
    padding: 20px;
    border-radius: 8px;
    box-shadow: 3px 3px 8px rgba(0, 0, 0, 0.1);
   }
label {
    font-weight: bold;
    font-size: 16px;
    color: #555;
    display: block;
    margin-bottom: 5px;
}
input[type="text"] {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}
select {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background: white;
    box-sizing: border-box;
}
td {
    padding: 6px;
}
td select {
    display: block;
}
</style>
</head>
<body>
    <?php 
        include '../includes/navAdmin.php'; 
    ?>
    <form id="qcmForm" action="../scripts/ajoute_qcm.php" method="POST">
        <table class="table-informat">
            <tr>
              <h2><?= $translations['Ajouter_un_QCM'] ?></h2>
            </tr>
            <tr>
               <td><select name="filiere">
                    <option value disabled selected><?= $translations['filiere'] ?></option>
                    <option value="1">AF</option>
                    <option value="2">BDDB</option>
                    <option value="3">DSE</option>
                    <option value="4">DS</option>
                    <option value="5">EASBD</option>
                    <option value="6">SDRO</option>
                    <option value="7">M2SI</option>
                  </select>
                </td>
                <td><select name="niveau">
                    <option value disabled selected><?= $translations['niveau_scolaire'] ?></option>
                    <option value="1">1ére Année (L1)</option>
                    <option value="2">2éme Année (L2)</option>
                    <option value="3">3éme Année (L3)</option>
                    <option value="4">Master 1(M1)</option>
                    <option value="5">Master 2(M2)</option>
                    </select>
                 </td>
            </tr>
            <tr>
               <td><label for="titre"><?= $translations['titre_qcm'] ?></label></td>
            </tr>
            <tr>
              <td><input type="text" id="titre" name="titre" required></td>
            </tr>
      </table>
                <h2><?= $translations['questions'] ?></h2>
                <div id="questionsContainer"></div>
        <button type="button" class ="addbtn" onclick="ajouterQuestion('<?= $lang ?>')">➕ <?= $translations['ajoute_une_question'] ?></button>
        <div class="btn-container">
           <button type="submit" class="submitbtn">💾 <?= $translations['enregestrer'] ?></button>
        </div>
    </form>
<script src="../assets/js/GQCM.js"></script>

<?php 
        include '../includes/footer.php'; 
?>
</body>
</html>
