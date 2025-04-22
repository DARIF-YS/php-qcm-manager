<form action="<?= isset($etudiant) ? '../scripts/alterStudent.php' : '../scripts/addStudent.php' ?>"
        method="POST" enctype="multipart/form-data">
    <?php if (isset($_GET['message'])) {?>
        <div class="alert alert-info" role="alert">
            <?PHP 
                echo htmlspecialchars($_GET['message']); // Afficher le message 
            ?>
        </div>    
    <?PHP    
    }
    ?>
    <table class="table text-center align-middle">
        <thead>
            <tr>
                <th>🧑‍🎓 <?= $translations['gestion_etudiants'] ?></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <select class="form-select" id="annee_scolaire_id" name="annee_scolaire_id" required>
                        <option value="" disabled selected><?= $translations['annee_scolaire'] ?></option>
                        <?php foreach ($annees as $annee) : ?>
                            <option value="<?= htmlspecialchars($annee['id']) ?>"
                                    <?= (isset($etudiant["annee_scolaire_id"]) && $etudiant["annee_scolaire_id"] == $annee['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($annee['lib_as']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td>
                    <select class="form-select" id="niveau_id" name="niveau_id" required>
                        <option value="" disabled selected><?= $translations['niveau_scolaire'] ?></option>
                        <?php foreach ($niveaux as $niveau) : ?>
                            <option value="<?= htmlspecialchars($niveau['id']) ?>"
                                    <?= (isset($etudiant["niveau_id"]) && $etudiant["niveau_id"] == $niveau['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($niveau['lib_niv']) ?> (<?= htmlspecialchars($niveau['abr_niv']) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td>
                    <select class="form-select" id="filiere_id" name="filiere_id" required>
                        <option value="" disabled selected><?= $translations['filiere'] ?></option>
                        <?php foreach ($filieres as $filiere) : ?>
                            <option value="<?= htmlspecialchars($filiere['id']) ?>"
                                    <?= (isset($etudiant["filiere_id"]) && $etudiant["filiere_id"] == $filiere['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($filiere['abr_fil']) ?> 
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" value="<?= isset($etudiant["nom"]) ? htmlspecialchars($etudiant["nom"]) : '' ?>"
                        class="form-control" id="nom_etd" name="nom_etd" placeholder="<?= $translations['nom'] ?>" required>
                </td>
                <td>
                    <input type="text" value="<?= isset($etudiant["prenom"]) ? htmlspecialchars($etudiant["prenom"]) : '' ?>"
                            class="form-control" id="prenom_etd" name="prenom_etd" placeholder="<?= $translations['prenom'] ?>" required>
                </td>
                <td rowspan="3">
                    <label for="photo_etd" class="file-label">
                        <img src="<?= isset($etudiant["photo"]) ? htmlspecialchars($etudiant["photo"]) : '../assets/image/student.png' ?>" 
                            alt="Image étudiant" width="100" height="100" style="border:2px solid; border-radius: 50%;" id="previewImage">
                    </label>
                    <input type="file" <?= isset($etudiant) ? '' : 'required' ?>
                            name='photo_etd' class="form-control-file" id="photo_etd" style="display: none;" accept="image/*" 
                    onchange="document.getElementById('previewImage').src = window.URL.createObjectURL(this.files[0])">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="email" value="<?= isset($etudiant["email"]) ? htmlspecialchars($etudiant["email"]) : '' ?>"
                            class="form-control" id="email_etd" name="email_etd" placeholder="<?= $translations['email'] ?>" required>
                </td>
                <td>
                    <label for="sexe_etd" class="form-label"><?= $translations['sexe'] ?></label>
                    <input type="radio" <?= (isset($etudiant["sexe"]) && $etudiant["sexe"] == 'M') ? 'checked' : '' ?>
                            id="masculin" name="sexe_etd" value="M" required>
                    <label for="masculin"><?= $translations['masculin'] ?></label>
                    <input type="radio" <?= (isset($etudiant["sexe"]) && $etudiant["sexe"] == 'F') ? 'checked' : '' ?>
                            id="feminin" name="sexe_etd" value="F" required>
                    <label for="feminin"><?= $translations['feminin'] ?></label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" value="<?= isset($etudiant["login"]) ? htmlspecialchars($etudiant["login"]) : '' ?>"
                            class="form-control" id="login_etd" name="login_etd" placeholder="<?= $translations['login'] ?>" required>
                </td>
                <td>
                    <input type="password" <?= isset($etudiant) ? '' : 'required' ?>
                            class="form-control" id="mp_etd" name="mp_etd" placeholder="<?= $translations['mot_de_passe'] ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" value="<?= isset($etudiant["matricule"]) ? htmlspecialchars($etudiant["matricule"]) : '' ?>"
                            class="form-control" id="matricule" name="matricule" placeholder="<?= $translations['matricule'] ?>" required>
                </td>
                <td>
                    <input type="number" hidden value="<?=$etudiant['id']?>" name="id_etudiant" >
                </td>
                <td>
                    <button type="submit" class="btn btn-success btn-sm"><?= $translations['ajouter'] ?></button>
                    <button type="reset" class="btn btn-danger btn-sm"><?= $translations['annuler'] ?></button>
                    <a onclick="document.getElementById('dataTable').style.display = 'table'" class="btn btn-info btn-sm" role="button"><?= $translations['afficher_liste'] ?></a>
                    <a class="btn btn-secondary btn-sm" href="../index.php" role="button"><?= $translations['quitter'] ?></a>
                </td>
            </tr>
        </tbody>
    </table>
</form>