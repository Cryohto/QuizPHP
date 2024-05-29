<?php
session_start();
if($_SESSION['nom']==null){
    header("Location: ../login/login.php");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"> <!-- Définit l'encodage des caractères à UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Assure que la page est réactive sur tous les appareils -->
    <title>Créer un Quiz - QuizMaster</title> <!-- Titre de la page -->
    <link rel="stylesheet" href="stylecreatequiz.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Créer un Nouveau Quiz</h1> <!-- Titre principal de la page -->
        </div>
    </header>
    <main>
        <div class="container">
            <form action="submit_quiz.php" method="post" class="quiz-form"> <!-- Formulaire qui envoie les données à submit_quiz.php via la méthode POST -->
                <h2>Détails du Quiz</h2>
                <label for="quiz_title">Titre du Quiz :</label>
                <input type="text" id="quiz_title" name="quiz_title" required> <!-- Champ de saisie pour le titre du quiz, requis -->

                <h2>Questions</h2> 
                <?php for ($i = 1; $i <= 5; $i++): ?> <!-- Boucle pour générer les champs de formulaire pour 5 questions -->
                    <fieldset> <!-- Regroupe les champs relatifs à une question -->
                        <legend>Question <?php echo $i; ?></legend> <!-- Légende du groupe de champs -->
                        <label for="question<?php echo $i; ?>">Question :</label> <!-- Étiquette pour le champ de texte de la question -->
                        <input type="text" id="question<?php echo $i; ?>" name="questions[<?php echo $i; ?>][question]" required> <!-- Champ de saisie pour la question, requis -->

                        <label for="option<?php echo $i; ?>a">Option A :</label> <!-- Étiquette pour l'option A -->
                        <input type="text" id="option<?php echo $i; ?>a" name="questions[<?php echo $i; ?>][options][a]" required> <!-- Champ de saisie pour l'option A, requis -->

                        <label for="option<?php echo $i; ?>b">Option B :</label> <!-- Étiquette pour l'option B -->
                        <input type="text" id="option<?php echo $i; ?>b" name="questions[<?php echo $i; ?>][options][b]" required> <!-- Champ de saisie pour l'option B, requis -->

                        <label for="option<?php echo $i; ?>c">Option C :</label> <!-- Étiquette pour l'option C -->
                        <input type="text" id="option<?php echo $i; ?>c" name="questions[<?php echo $i; ?>][options][c]" required> <!-- Champ de saisie pour l'option C, requis -->

                        <label for="option<?php echo $i; ?>d">Option D :</label> <!-- Étiquette pour l'option D -->
                        <input type="text" id="option<?php echo $i; ?>d" name="questions[<?php echo $i; ?>][options][d]" required> <!-- Champ de saisie pour l'option D, requis -->

                        <label for="answer<?php echo $i; ?>">Bonne réponse :</label> <!-- Étiquette pour sélectionner la bonne réponse -->
                        <select id="answer<?php echo $i; ?>" name="questions[<?php echo $i; ?>][answer]" required> <!-- Liste déroulante pour sélectionner la bonne réponse, requis -->
                            <option value="a">Option A</option> 
                            <option value="b">Option B</option> 
                            <option value="c">Option C</option> 
                            <option value="d">Option D</option>
                        </select>
                    </fieldset>
                <?php endfor; ?> <!-- Fin de la boucle -->

                <input type="submit" value="Créer le Quiz"> <!-- Bouton pour soumettre le formulaire -->
            </form>
        </div>
                </br>
                </br>
        <a href="../index/index.php" button class="login-btn">Page d'accueil</button> </a>
    </main>
</body>
</html>
