<?php

if(
    isset($_POST['email']) &&
    isset($_POST['password']) &&
    isset($_POST['confirm-password']) &&
    isset($_POST['pseudonym']) &&
    isset($_POST['g-recaptcha-response'])
    ){

if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){

    $errors[] = '<p class="alert alert-danger">Votre adresse e-mail est invalide !</p>';

}

if(!preg_match('/^(?=.{10,}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$/', $_POST['password'])){

    $errors[] = '<p class="alert alert-danger">Le mot de passe doit comprendre au moins 8 caractères dont 1 lettre minuscule, 1 majuscule, un chiffre et un caractère spécial.</p>';

}

if($_POST['confirm-password'] != $_POST['password']){

    $errors[] = '<p class="alert alert-danger">La confirmation ne correspond pas au mot de passe</p>';

}

if(mb_strlen($_POST['pseudonym']) < 1 || mb_strlen($_POST['pseudonym']) > 50){

    $errors[] = '<p class="alert alert-danger">Le pseudonyme doit contenir entre 1 et 50 caractères</p>';

}

if(!recaptchaValid($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR'])){

    $errors[] = '<p class="alert alert-danger">Veuillez remplir correctement le captcha</p>';

}

if(!isset($errors)){

    $success = '<p class="alert alert-success">Votre compte à bien été créé !</p>';

}

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
    require 'inclusion/links.php';?>
    <title>Document</title>
</head>
<body>
<?php require_once 'inclusion/menu.php' ?>

<div class="container-fluid">

    <div class="row">

        <div class="col-12 col-md-8 offset-md-2 py-5">
            <p class="text-center"><a class="text-decoration-none" href="register2.php">Voir la version "bonus" avancée de la page d'inscription</a></p>
            <h1 class="pb-4 text-center">Créer un compte sur Wikifruit</h1>

            <div class="col-12 col-md-6 mx-auto">
                <?php 
            if (isset($errors)){
                foreach ($errors as $error){
                    echo $error;
                }
            }
                ?>
                
                <form action="register.php" method="POST">

                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input id="email" type="text" name="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe <span class="text-danger">*</span></label>
                        <input id="password" type="password" name="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="confirm-password" class="form-label">Confirmation mot de passe <span class="text-danger">*</span></label>
                        <input id="confirm-password" type="password" name="confirm-password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="pseudonym" class="form-label">Pseudonyme <span class="text-danger">*</span></label>
                        <input id="pseudonym" type="text" name="pseudonym" class="form-control">
                    </div>
                    <div class="mb-3">
                        <p class="mb-2">Captcha <span class="text-danger">*</span></p>
                        <div class="g-recaptcha" data-sitekey="6Ld5YncfAAAAALlArYeHCWbuIIAllwsRvu7OU3g3"></div>
                    </div>
                    <div>
                        <input value="Créer mon compte" type="submit" class="btn btn-success col-12">
                    </div>

                    <p class="text-danger mt-4">* Champs obligatoires</p>

                </form>
                    </div>
    <?php require_once 'inclusion/scrpt_B.php';?>
</body>
</html>