<?php

require 'inclusion/pdo.php';

if(isset($_POST['email']) &&
 isset($_POST['password'])
 ){

    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){

        $errors[] = '<p class="alert alert-danger">Votre adresse e-mail est invalide !</p>';

    }

    if(!preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[ !"#\$%&\'()*+,\-.\/:;<=>?@[\\\\\]\^_`{\|}~]).{8,4096}$/u', $_POST['password'])){

        $errors[] = '<p class="alert alert-danger">Le mot de passe doit comprendre au moins 8 caractères dont 1 lettre minuscule, 1 majuscule, un chiffre et un caractère spécial.</p>';

    }

    $userInfo = $db->prepare("SELECT * FROM users WHERE email=?");

    $userInfo->execute([$_POST['email']]);

    $user = $userInfo->fetch();

    if($user){

        $password = $db->prepare("SELECT * FROM users WHERE password=?");

        $userPassword->execute([$_POST['password']]);

        $userPassInfo = $userPassword->fetch();

        if($userPassInfo){

            echo 'coucou';

        } else{

            $errors[] = '<p class="alert alert-danger">Le mot de passe est invalide !</p>';

        }


    } else{

        $errors[] = '<p class="alert alert-danger">Ce compte n\'existe pas !</p>';

    }

    if(!isset($errors)){



    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require 'inclusion/links.php'?>
    <title>Connexion - Wikifruit</title>
</head>
<body>
    <?php require_once 'inclusion/menu.php' ?>

            <?php

                if(isset($errors)){

                        foreach($errors as $error){

                        echo $error;

                    }

                }

                if(isset($success)){

                    echo $success;

                } else{

                    ?>

<div class="container-fluid">

<div class="row">

    <div class="col-12 col-md-8 offset-md-2 py-5">
        <p class="text-center"><a class="text-decoration-none" href="login2.php">Voir la version "bonus" avancée de la page de connexion</a></p>
        <h1 class="pb-4 text-center">Connexion</h1>


        <div class="col-12 col-md-6 offset-md-3">
            
                <form action="login.php" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="text" name="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input id="password" type="password" name="password" class="form-control">
                    </div>
                    <div>
                        <input value="Connexion" type="submit" class="btn btn-primary col-12">
                    </div>
                </form>

                
        </div>

    </div>

</div>
<?php

}

?>
    <?php require_once 'inclusion/scrpt_B.php'; ?>

</body>
</html>