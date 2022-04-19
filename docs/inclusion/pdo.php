<?php
try{
        $db = new PDO('mysql:host=localhost;dbname=projet_php_final;charset=utf8', 'root', '');
    } catch(Exception $e){
        die( 'Problème avec la base de données ! ' . $e->getMessage() );
    }
?>