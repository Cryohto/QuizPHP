<?php
session_start();


try{
    $dsn = "mysql:dbname=quiz;host=localhost";
    $user="root";
    $password= "";

    $db = new PDO($dsn, $user,$password);
}catch(PDOException $e){
    die('Erreur'.$e);
}


if(isset($_POST['nom']) && ($_POST['motdepasse']) && !empty($_POST['nom'] && !empty($_POST['motdepasse']))){

$motdepasse = $_POST["motdepasse"];
$nom = $_POST["nom"];

$verifmdp= $db -> prepare('SELECT * from login WHERE `user` = ?;');
$verifmdp -> bindValue(1, $nom);
$verifmdp -> execute();



$result = $verifmdp -> fetch();

$_SESSION['nom'] = $result['user'];




if (password_verify($motdepasse,$result['password'])) {
    header('Location: ../index/index.php');
} else {
    echo 'Le mot de passe est invalide.';
}



}
