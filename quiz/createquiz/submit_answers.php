<?php
session_start();
if($_SESSION['nom']==null){
    header("Location: ../login/login.php");
}
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $quiz_id = (int)$_POST['quiz_id']; // Récupère l'ID du quiz
    $answers = $_POST['answers']; // Récupère les réponses fournies par l'utilisateur

    $score = 0; // Initialisation du score
    $total_questions = count($answers); // Nombre total de questions répondues

    // Récupérer les bonnes réponses des questions
    $stmt = $db->prepare("SELECT id, answer FROM questions WHERE quiz_id = :quiz_id");
    $stmt->bindParam(':quiz_id', $quiz_id, PDO::PARAM_INT);
    $stmt->execute();
    $correct_answers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Vérifier les réponses fournies par l'utilisateur
    foreach ($correct_answers as $correct_answer) {
        $question_id = $correct_answer['id'];
        if (isset($answers[$question_id]) && $answers[$question_id] == $correct_answer['answer']) {
            $score++; // Incrémente le score pour chaque bonne réponse
        }
    }

    // Calcul du pourcentage de bonnes réponses
    $percentage = ($score / $total_questions) * 100;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats du Quiz</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .result-container { width: 80%; margin: auto; padding: 20px; background-color: #f4f4f4; text-align: center; }
        .result-container h1 { color: #4CAF50; }
        .result-container a { text-decoration: none; color: #000; }
        .result-container a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="result-container">
        <h1>Résultats du Quiz</h1>
        <p>Votre score est de <?php echo $score; ?> sur <?php echo $total_questions; ?> questions, soit <?php echo $percentage; ?>% de bonnes réponses.</p>
        <!-- Lien vers la page d'accueil -->
        <p><a href="../index/index.php">Page d'accueil</a></p>
    </div>
</body>
</html>
