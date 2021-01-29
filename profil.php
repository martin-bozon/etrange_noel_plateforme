<?php
require("classes/User.php");
require('classes/Database.php');
session_start();
if (!isset($_SESSION['user']['id_user'])) {
    header('Location:index.php');
}
$url = 'profil.php';
$db = new Database('noel_plateforme');
$pdo = $db->getPDO();
$user = new User($pdo);
$user->setId($_SESSION['user']['id_user']);
$hobbies = $user->getHobbies();

$hobby1 = $hobbies["hobby1"];
$hobby2 = $hobbies["hobby2"];
$hobby3 = $hobbies["hobby3"];
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/e9a44ab6cf.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="ressources/IMG/christmas.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Grenze+Gotisch:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="ressources/CSS/style.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="ressources/JS/hobbies.js"></script>
    <script src="ressources/JS/script.js"></script>
    <title>Mon profil</title>
</head>
<body>
<?php include 'includes/header_profil.php'; ?>
<main>
    <h1 id="h1_profil" class="text-align-center my-1rem mx-auto">Compte à rebours</h1>
    <table id="compte_a_rebours" class="my-1rem mx-auto max-width-content">
        <thead>
        <td>Jours</td>
        <td>Heures</td>
        <td>Minutes</td>
        <td>Secondes</td>
        </thead>
        <tbody>
        <td id="jours_register"></td>
        <td id="heures_register"></td>
        <td id="minutes_register"></td>
        <td id="secondes_register"></td>
        </tbody>
    </table>

    <section class="pseudo_profil my-2rem" id="bouton_container">
        <h2>Pseudo secret</h2>
        <p id="info_pseudo">Ne sera dévoilé que le jour de l'évènement</p>
    </section>

    <section class="profil" id="profil_container">
        <div class="hobbies">
            <h2 id="title_hobbies" class="text-align-center">Inscrivez 3 de vos centres d'intérêt</h2>
            <form id="form_hobbies" class="add_hobbies flex-column justify-content-center align-items-center" action="" method="post">
                <ol class="flex-column justify-content-center align-items-center">
                    <li class="li_hobby flex-row justify-content-center align-items-center">
                        <input class="input_hobby flex-1" type="text" name="hobby1"
                               value="<?= ($hobby1 != '') ? $hobby1 : '' ?>"
                               placeholder="<?= ($hobby1 != '') ? '' : 'Non renseigné' ?>"
                               id="hobby1">
                        <i id="check_hobby1" class="fas fa-check <?= ($hobby1 != '') ? 'green-text' : '' ?>"></i>
                    </li>
                    <li class="li_hobby flex-row justify-content-center align-items-center">
                        <input class="input_hobby flex-1" type="text" name="hobby2"
                               value="<?= ($hobby2 != '') ? $hobby2 : '' ?>"
                               placeholder="<?= ($hobby2 != '') ? '' : 'Non renseigné' ?>"
                               id="hobby2">
                        <i id="check_hobby2" class="fas fa-check <?= ($hobby2 != '') ? 'green-text' : '' ?>"></i>
                    </li>
                    <li class="li_hobby flex-row justify-content-center align-items-center">
                        <input class="input_hobby flex-1" type="text" name="hobby3"
                               value="<?= ($hobby3 != '') ? $hobby3 : '' ?>"
                               placeholder="<?= ($hobby3 != '') ? '' : 'Non renseigné' ?>"
                               id="hobby3">
                        <i id="check_hobby3" class="fas fa-check <?= ($hobby3 != '') ? 'green-text' : '' ?>"></i>
                    </li>
                </ol>
                <button id="form_hobbies_valider" type="submit" name="button">Valider</button>
            </form>
        </div>

        <div class="destinataire">
            <h2 class="text-align-center">Personne attribuée</h2>
            <i class="fas fa-question-circle"></i>
            <p>Son pseudo apparaîtra à la fin du compte à rebours</p>
        </div>

    </section>
</main>
    <?php include 'includes/footer.php'; ?>
</body>
<script src="ressources/JS/countdown.js"></script>
<!-- Script bouton -->
</html>
