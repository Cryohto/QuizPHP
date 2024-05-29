<?php
// Connexion à la base de données via PDO
try {
    $dsn = "mysql:dbname=quiz;host=localhost"; // Chaîne de connexion pour la base de données
    $user = "root"; // Nom d'utilisateur de la base de données
    $password = ""; // Mot de passe de la base de données

    $db = new PDO($dsn, $user, $password); // Création de la connexion PDO
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Configuration pour afficher les erreurs PDO
} catch (PDOException $e) {
    die('Erreur: ' . $e->getMessage()); // Affiche un message d'erreur et arrête le script si la connexion échoue
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Vérifie si le formulaire a été soumis
    $quiz_title = $_POST['quiz_title']; // Récupère le titre du quiz
    $questions = $_POST['questions']; // Récupère les questions du quiz

    try {
        // Début de la transaction
        $db->beginTransaction();

        // Insérer les détails du quiz dans la base de données
        $stmt = $db->prepare("INSERT INTO quizzes (title) VALUES (:title)");
        $stmt->bindParam(':title', $quiz_title); // Lie le paramètre :title au titre du quiz
        $stmt->execute(); // Exécute la requête
        $quiz_id = $db->lastInsertId(); // Récupère l'ID du quiz nouvellement inséré

        // Préparer la requête pour insérer les questions
        $stmt = $db->prepare("INSERT INTO questions (quiz_id, question, option_a, option_b, option_c, option_d, answer) 
                                VALUES (:quiz_id, :question, :option_a, :option_b, :option_c, :option_d, :answer)");

        foreach ($questions as $question) { // Boucle à travers chaque question
            $question_text = $question['question']; // Récupère le texte de la question
            $option_a = $question['options']['a']; // Récupère l'option A
            $option_b = $question['options']['b']; // Récupère l'option B
            $option_c = $question['options']['c']; // Récupère l'option C
            $option_d = $question['options']['d']; // Récupère l'option D
            $answer = $question['answer']; // Récupère la bonne réponse

            // Lier les paramètres et exécuter la requête pour chaque question
            $stmt->bindParam(':quiz_id', $quiz_id); // Lie le paramètre :quiz_id à l'ID du quiz
            $stmt->bindParam(':question', $question_text); // Lie le paramètre :question au texte de la question
            $stmt->bindParam(':option_a', $option_a); // Lie le paramètre :option_a à l'option A
            $stmt->bindParam(':option_b', $option_b); // Lie le paramètre :option_b à l'option B
            $stmt->bindParam(':option_c', $option_c); // Lie le paramètre :option_c à l'option C
            $stmt->bindParam(':option_d', $option_d); // Lie le paramètre :option_d à l'option D
            $stmt->bindParam(':answer', $answer); // Lie le paramètre :answer à la bonne réponse
            $stmt->execute(); // Exécute la requête
        }

        // Valider la transaction
        $db->commit(); // Valide la transaction

        echo "Quiz créé avec succès !"; // Message de succès
        echo "<a href='../index/index.php' class='login-btn'>Page d'accueil</a>"; // Lien vers la page d'accueil
    } catch (PDOException $e) {
        // Annuler la transaction en cas d'erreur
        $db->rollBack(); // Annule la transaction en cas d'erreur
        echo "Erreur: " . $e->getMessage(); // Affiche un message d'erreur en cas d'échec
    }

    // Ferme la connexion à la base de données
    $db = null; // Ferme la connexion à la base de données
}
?>
