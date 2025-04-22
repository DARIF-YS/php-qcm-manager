<table class="table align-middle mb-0 bg-white" id="dataTable" style="display: none;">
  <thead class="bg-light">
    <tr>
        <th><?= $translations['nom'] ?></th>
        <th><?= $translations['formation'] ?></th>
        <th><?= $translations['annee_scolaire'] ?></th>
        <th><?= $translations['sexe'] ?></th>
        <th><?= $translations['matricule'] ?></th>
        <th><?= $translations['operations'] ?></th>
    </tr>
  </thead>
  <tbody>
    
    <?php foreach ($etudiants as $etudiant) : ?>    
      <tr>
      <td>
        <div class="d-flex align-items-center">
          <img
              src="<?= htmlspecialchars($etudiant['photo_etd']) ?> "
              alt="image de <?= htmlspecialchars($etudiant['prenom_etd']) ?> "
              style="width: 45px; height: 45px"
              class="rounded-circle"
              />
          <div class="ms-3">
            <p class="fw-bold mb-1">
                <?= htmlspecialchars($etudiant['prenom_etd']) ?> 
                <?= htmlspecialchars($etudiant['nom_etd']) ?>  
            </p>
            <p class="text-muted mb-0">
              <?= htmlspecialchars($etudiant['email_etd']) ?>
            </p>
          </div>
        </div>
      </td>
      <td>
        <p class="fw-normal mb-1">
        <?= htmlspecialchars(getFiliere( $etudiant['filiere_id']) )?>
        </p>
        <p class="text-muted mb-0">
        <?= htmlspecialchars(getNiveau($etudiant['niveau_id'])['abr_niv'] )?>
        </p>
      </td>
      <td>
      <?= htmlspecialchars(getAnneesScolaires( $etudiant['annee_scolaire_id'])['lib_as'] )?>
      </td>
      <td>
        <?= htmlspecialchars($etudiant['sexe_etd']) ?>
      </td>
      <td>
        <?= htmlspecialchars($etudiant['matricule_etd']) ?>
      </td>
      <td>
        <div class="d-flex align-items-center gap-2">
            <form method="POST" action="../scripts/getStudentData.php">
                <input type="hidden" name="id" value="<?= $etudiant['id'] ?>">
                <button type="submit" class="btn btn-outline-primary btn-sm rounded-circle">
                    📝
                </button>
            </form>
            <form method="POST" action="../scripts/deleteStudent.php" onsubmit="return confirm('Voulez-vous vraiment supprimer cet étudiant ?');">
                <input type="hidden" name="id" value="<?= $etudiant['id'] ?>">
                <button type="submit" class="btn btn-outline-danger btn-sm rounded-circle">
                    ❌
                </button>
            </form>
        </div>
    </td>

      </tr>
    <?php endforeach; ?>
    
  </tbody>
</table><table class="table align-middle mb-0 bg-white" id="dataTable" style="display: none;">
  <thead class="bg-light">
    <tr>
        <th><?= $translations['nom'] ?></th>
        <th><?= $translations['formation'] ?></th>
        <th><?= $translations['annee_scolaire'] ?></th>
        <th><?= $translations['sexe'] ?></th>
        <th><?= $translations['matricule'] ?></th>
        <th><?= $translations['operations'] ?></th>
    </tr>
  </thead>
  <tbody>
    
    <?php foreach ($etudiants as $etudiant) : ?>    
      <tr>
      <td>
        <div class="d-flex align-items-center">
          <img
              src="<?= htmlspecialchars($etudiant['photo_etd']) ?> "
              alt="image de <?= htmlspecialchars($etudiant['prenom_etd']) ?> "
              style="width: 45px; height: 45px"
              class="rounded-circle"
              />
          <div class="ms-3">
            <p class="fw-bold mb-1">
                <?= htmlspecialchars($etudiant['prenom_etd']) ?> 
                <?= htmlspecialchars($etudiant['nom_etd']) ?>  
            </p>
            <p class="text-muted mb-0">
              <?= htmlspecialchars($etudiant['email_etd']) ?>
            </p>
          </div>
        </div>
      </td>
      <td>
        <p class="fw-normal mb-1">
        <?= htmlspecialchars(getFiliere( $etudiant['filiere_id']) )?>
        </p>
        <p class="text-muted mb-0">
        <?= htmlspecialchars(getNiveau($etudiant['niveau_id'])['abr_niv'] )?>
        </p>
      </td>
      <td>
      <?= htmlspecialchars(getAnneesScolaires( $etudiant['annee_scolaire_id'])['lib_as'] )?>
      </td>
      <td>
        <?= htmlspecialchars($etudiant['sexe_etd']) ?>
      </td>
      <td>
        <?= htmlspecialchars($etudiant['matricule_etd']) ?>
      </td>
      <td>
        <form method="POST" action="../scripts/getStudentData.php">
          <input type="hidden" name="id" value="<?= $etudiant['id'] ?>">
          <button type="submit" class="btn btn-link btn-sm btn-rounded"> 📝 </button>
        </form>
        <form method="POST" action="../scripts/deleteStudent.php" onsubmit="return confirm('Voulez-vous vraiment supprimer cet étudiant ?');">
          <input type="hidden" name="id" value="<?= $etudiant['id'] ?>">
          <button type="submit" class="btn btn-link btn-sm btn-rounded"> ❌ </button>
        </form>
      </td>
      </tr>
    <?php endforeach; ?>
    
  </tbody>
</table>