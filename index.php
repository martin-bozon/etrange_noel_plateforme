<?php
session_start();
$url = 'index.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="ressources/IMG/christmas.png">
    <link rel="stylesheet" href="ressources/CSS/style.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="ressources/JS/script.js"></script>
    <script src="ressources/JS/function-index.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Grenze+Gotisch:wght@300;400&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e9a44ab6cf.js" crossorigin="anonymous"></script>
    <title>L'étrange Noël de La Plateforme_</title>
</head>
<body>
  <?php include 'includes/header.php'; ?>
<main>
    <section class="section_index flex-column max-width-content mx-auto min-height-50vh justify-content-center">
        <h2 class="text-center">Bienvenue à l'étrange noël de La Plateforme_ !</h2>
        <p  class="text-center">Le principe ?</p>
        <p  class="text-center">Il s'agit d'un échange anonyme de cadeaux ! Notre petit plus : une liste de hobbies qui orientera votre
            <span class="font-goth">Secret Santa</span> dans son choix de cadeau (Votre cadeaux devra valoir au minimum 5€).</p>
        <ol>
            <li><i class="fas fa-gift"></i> Etape 1 : Créez votre compte et renseignez vos hobbies</li>
            <li><i class="fas fa-gift"></i> Etape 2 : Le 11 décembre, c'est le jour du tirage au sort ! Vous connaîtrez le pseudo (aléatoire) de la personne
                à qui vous offrez le cadeau ainsi que ses hobbies <i class="fas fa-smile-beam"></i>
            </li>
            <li><i class="fas fa-gift"></i> Etape 3 : Le 04 janvier, c'est le jour J ! Vous découvrirez votre propre pseudo et offrirez votre merveilleux cadeau à la personne désignée</li>
        </ol>
        <button id="inscription" class="<?= !isset($_SESSION['user']['id_user']) ? '' : 'd-none' ?> clickable">S'inscrire</button>
    </section>
</main>

<?php
include 'includes/footer.php'; ?>
</body>
</html>
