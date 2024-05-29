<?php
session_start();
if($_SESSION['nom']==null){
    header("Location: ../login/login.php");
}
?><?php

// Connexion à la base de données via PDO
try {
    $dsn = "mysql:dbname=quiz;host=localhost"; // Chaîne de connexion pour la base de données
    $user = "root"; // Nom d'utilisateur de la base de données
    $password = ""; // Mot de passe de la base de données

    // Création de la connexion PDO
    $db = new PDO($dsn, $user, $password);
    // Configuration pour afficher les erreurs PDO
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Affiche un message d'erreur et arrête le script si la connexion échoue
    die('Erreur: ' . $e->getMessage());
}

// Récupérer tous les quizzes
$stmt = $db->query("SELECT * FROM quizzes");
$quizzes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Quizzes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Bouton de déconnexion -->
    <form action="logout.php" method="post">
    <a href="../phpdoss/deconnexion.php" button class="login-btn">Deconnexion</button> </a>
    </form>

    <div class="quiz-list">
        <h1>Liste des Quizzes</h1>
        <?php foreach ($quizzes as $quiz): ?>
            <div class="quiz-item">
                <!-- Lien vers la page du quiz avec l'ID du quiz en paramètre -->
                <a href="quiz.php?quiz_id=<?php echo $quiz['id']; ?>"><?php echo htmlspecialchars($quiz['title']); ?></a>
            </div>
        <?php endforeach; ?>
    </div>
    <a href="../createquiz/create_quiz.php" button class="login-btn">Crée un quiz</button> </a>
</body>
</html>
