<nav class="navbar navbar-light bg-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="../assets/icons/INSEA_logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
            InseaQuiz
        </a>
        <div class="d-inline-block ms-3">
        <div class="d-flex align-items-center">
        <!-- Gestion des QCM avec dropdown -->
            <div class="dropdown mx-2">
                <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <?= $translations['gestion_qcm'] ?>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="../pages/ListerQCM.php?lang=<?= $_GET['lang'] ?? 'fr' ?>">Lister QCM</a></li>
                    <li><a class="dropdown-item" href="../pages/AjoutQCM.php?lang=<?= $_GET['lang'] ?? 'fr' ?>">Ajouter QCM</a></li>
                </ul>
            </div>

        <!-- Gestion des étudiants -->
        <a href="../pages/MStudent.php" class="btn btn-outline-secondary mx-2"><?= $translations['gestion_etud'] ?></a>

        <!-- Icônes de langue -->
        <a href="?lang=ar" class="text-decoration-none mx-2 text-black"> 
            <img src="../assets/icons/mr.png" width="20" alt="Ar">
        </a>
        <a href="?lang=en" class="text-decoration-none mx-2 text-black">
            <img src="../assets/icons/us.png" width="20" alt="En">
        </a>
        <a href="?lang=fr" class="text-decoration-none mx-2 text-black">
            <img src="../assets/icons/fr.png" width="20" alt="Fr">
        </a>
    </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</nav>
