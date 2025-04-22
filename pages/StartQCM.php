<?php
require_once "../config/connexion.php";
?>
<?php
  // Assurez-vous que l'utilisateur est connecté
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Récupération des informations de l'étudiant
$id_etudiant = $_SESSION['user_id'];
$sql = "SELECT nom_etd, prenom_etd, email_etd, matricule_etd, filiere_id, niveau_id, annee_scolaire_id, photo_etd FROM etudiant WHERE id = :id_etudiant";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id_etudiant', $id_etudiant, PDO::PARAM_INT);
$stmt->execute();
$etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

$sql2= "SELECT lib_niv from niveau where id=$etudiant[niveau_id]";
$stm = $pdo->prepare($sql2);
$stm->execute();
$niv = $stm->fetchColumn();

$sql3= "SELECT lib_fil from filiere where id=$etudiant[filiere_id]";
$stm = $pdo->prepare($sql3);
$stm->execute();
$fil = $stm->fetchColumn();

$sql4= "SELECT lib_as from annee_scolaire where id = $etudiant[annee_scolaire_id]";
$stm = $pdo->prepare($sql4);
$stm->execute();
$annee = $stm->fetchColumn();

// Vérifier si une image existe
$image_path = !empty($etudiant['photo_etd']) ? $etudiant['photo_etd'] : '../uploads/avatar.png'; 

// Requête SQL pour récupérer les QCM que l'étudiant doit passer
$sql = "
    SELECT qcm.id_qcm, qcm.titre, qcm.filiere, qcm.niveau, valeur
    FROM qcm
    LEFT JOIN score ON qcm.id_qcm = score.id_qcm AND score.id_etudiant = :id_etudiant
    WHERE qcm.filiere = :filiere_id 
    AND qcm.niveau = :niveau_id;
";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id_etudiant', $id_etudiant, PDO::PARAM_INT);
$stmt->bindParam(':filiere_id', $etudiant['filiere_id'], PDO::PARAM_INT);
$stmt->bindParam(':niveau_id', $etudiant['niveau_id'], PDO::PARAM_INT);
$stmt->execute();
$qcms = $stmt->fetchAll();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>▶QCM Disponibles</title>
    <link rel="icon" type="image/png" href="../assets/icons/INSEA_logo.png">
    <link rel="stylesheet" href="../assets/css/info.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      <style>
h1 {
    color: #12c479;
    font-size: 24px;
    margin-bottom: 0px;
}
.profile-left {
    display: flex;
    flex-direction: column;
    align-items: end;
}
.taklalaw {
    margin-top: 0px;
    font-size: 14px;
    color: #333;
    background: #f8f9fa;
    padding: 5px 10px;
    border-radius: 5px;
    text-align: center;
    font-weight: bold;
}
table {
    margin: 20px auto;
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-size: 16px;
    text-align: center;
    background-color: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* En-tête de la table */
thead {
    background-color:rgb(86, 221, 97);
    color: white;
}

th, td {
    padding: 12px 15px;
    border-bottom: 1px solid #ddd;
}
.btn {
  
    text-decoration: none;
    padding: 6px 12px;
    border-radius: 4px;
    font-size: 14px;
}

a[href^="voir_qcm.php"] {
    background-color: #28a745;
    color: white;
}
a[href^="passer_qcm.php"] {
    background-color:rgb(57, 86, 216);
    color: white;
}
.circle {
    display: inline-block;
    width: 15px;
    height: 15px;
    border-radius: 50%;
    background-color: grey; 
    border: 1px solid #ccc;
}

.passed {
    background-color: #28a745; 
    border-color: #1e7e34;
}

.not-passed {
    background-color: #dc3545; /* Rouge */
    border-color: #a71d2a;
}
      </style>
  </head>
  <body>
    <?php 
        include '../includes/navStudent.php'; 
    ?>

     <div class="container">
    <h1>Informations de l'étudiant</h1>
    
    <div class="profile">
          <div class="profile-left">
            <p class="taklalaw"><strong>Année scolaire :</strong> <?php echo htmlspecialchars($annee); ?></p>
          </div>
          <img src="<?php echo $image_path; ?>" alt="Photo de profil" class="profile-img">
          <div class="profile-info">
            <p><strong>Nom :</strong> <?php echo htmlspecialchars($etudiant['nom_etd']); ?></p>
            <p><strong>Prénom :</strong> <?php echo htmlspecialchars($etudiant['prenom_etd']); ?></p>
            <p><strong>Email :</strong> <?php echo htmlspecialchars($etudiant['email_etd']); ?></p>
            <p><strong>Matricule :</strong> <?php echo htmlspecialchars($etudiant['matricule_etd']); ?></p>
            <p><strong>Filière :</strong> <?php echo htmlspecialchars($fil); ?></p>
            <p><strong>Niveau :</strong> <?php echo htmlspecialchars($niv); ?></p>
          </div>
    </div> 


<div class="container1">
    <h1>Liste des QCM</h1>
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Statut</th>
                <th>Score</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($qcms)) : ?>
                <?php foreach ($qcms as $qcm) : ?>
                    <?php 
                        $qcm_passe = ($qcm['valeur'] !== null);
                        $score = $qcm_passe ? $qcm['valeur'] : '';
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($qcm['titre']); ?></td>
                        <td class="status">
                            <span class="circle <?php echo $qcm_passe ? 'passed' : 'not-passed'; ?>"></span>
                        </td>
                        <td><?php echo $score; ?></td>
                        <td>
                            <?php if (!$qcm_passe) : ?>
                                <a href="passer_qcm.php?id= <?php echo $qcm['id_qcm']; ?>" class="btn">✏️ Passer</a>
                                
                                
                            <?php else : ?>
                              <a href="voir_qcm.php?id= <?php echo $qcm['id_qcm']; ?>" class="btn">👀 Voir</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4">Aucun QCM disponible.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</div>
    <?php 
        include '../includes/footer.php'; 
    ?>
    <script src="../assets/js/main.js"></script>
  </body>
</html>
