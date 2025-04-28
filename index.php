<?php
//echo password_hash('younes',PASSWORD_DEFAULT);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InseaQuiz</title>
    <html lang="<?= $_SESSION['lang']; ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="./assets/icons/INSEA_logo.png">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .center{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; 
            margin: 0; 
        }
    </style>
</head>
<body>
<div class="container">
  <div class="position-absolute top-0 start-50 translate-middle-x mt-3 text-center">

    <a href="./pages/about.php" class="btn text-info">
        <img src="./assets/icons/INSEA_logo.png" alt="À propos" style="width: 80px; height: 80px;"><br>
     <hr class="hr hr-blurry" />
        💬 About the team & project
     <hr class="hr hr-blurry" />

    </a>
  </div>
</div>
    <div class="center">
        <form action="./scripts/login.php" method="POST" >
            <?php if (isset($_GET['message'])) {?>
                <div class="alert alert-danger" role="alert">
                    <?PHP 
                        echo htmlspecialchars($_GET['message']); // Afficher le message 
                    ?>
                </div>    
            <?PHP    
            }
            ?>
            <div class="form-group" style="width: 10cm;">
                <label for="login">Login</label>
                <input type="text" class="form-control" name="login" aria-describedby="emailHelp" placeholder="Enter login">
                <small id="emailHelp" class="form-text text-muted">Entrer votre login ici.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            <div class="form-check form-check-inline mt-1">
            <input class="form-check-input" checked  type="radio" name="role" id="inlineRadio1" value="admin">
            <label class="form-check-label" for="inlineRadio1" >Admin</label>
            </div>
            <div class="form-check form-check-inline mt-1">
            <input class="form-check-input" type="radio" name="role" id="inlineRadio2" value="etudiant">
            <label class="form-check-label" for="inlineRadio2">Etudiant</label>
            </div>
            <br>
            <button type="submit" class="btn btn-primary btn-sm mt-2">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="assets/js/main.js"></script>

</body>
</html>