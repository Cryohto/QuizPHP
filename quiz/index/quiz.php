<?php
session_start();
if($_SESSION['nom']==null){
    header("Location: ../login/login.php");
}
?>
<?php
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

// Vérifie que le quiz_id est fourni
if (!isset($_GET['quiz_id'])) {
    die('Quiz ID is required');
}

$quiz_id = (int)$_GET['quiz_id']; // Récupère l'ID du quiz

// Récupérer les questions et les réponses du quiz
$stmt = $db->prepare("SELECT * FROM questions WHERE quiz_id = :quiz_id");
$stmt->bindParam(':quiz_id', $quiz_id, PDO::PARAM_INT);
$stmt->execute();
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="quiz-container">
        <h1>Quiz</h1>
        <!-- Formulaire pour soumettre les réponses au quiz -->
        <form method="post" action="../createquiz/submit_answers.php">
            <?php foreach ($questions as $index => $question): ?>
                <div class="question">
                    <p><?php echo htmlspecialchars($question['question']); ?></p>
                    <ul class="options">
                        <!-- Options de réponse pour chaque question -->
                        <li><label><input type="radio" name="answers[<?php echo $question['id']; ?>]" value="a" required> <?php echo htmlspecialchars($question['option_a']); ?></label></li>
                        <li><label><input type="radio" name="answers[<?php echo $question['id']; ?>]" value="b" required> <?php echo htmlspecialchars($question['option_b']); ?></label></li>
                        <li><label><input type="radio" name="answers[<?php echo $question['id']; ?>]" value="c" required> <?php echo htmlspecialchars($question['option_c']); ?></label></li>
                        <li><label><input type="radio" name="answers[<?php echo $question['id']; ?>]" value="d" required> <?php echo htmlspecialchars($question['option_d']); ?></label></li>
                    </ul>
                </div>
            <?php endforeach; ?>
            <!-- Champ caché pour transmettre l'ID du quiz -->
            <input type="hidden" name="quiz_id" value="<?php echo $quiz_id; ?>">
            <button type="submit" class="submit-btn">Submit</button>
        </form>
    </div>
</body>
</html>
