<?php


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
$motdepasse = password_hash($motdepasse,PASSWORD_DEFAULT);

$crea= $db -> prepare('INSERT INTO login (user,password) values(?,?)');
$crea -> bindValue(2,$motdepasse);
$crea -> bindValue(1,$nom);
$crea -> execute();
echo("Le compte a été crée");
echo("<a href='../login/login.php' button class='login-btn'>  Login Page</button> </a>");
}
?>