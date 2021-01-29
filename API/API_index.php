<?php

session_start();
require '../classes/Database.php';
require '../classes/PseudoAttribution.php';
$db = new Database('noel_plateforme');
$pdo = $db->getPDO();

// Inscription
if (isset($_POST['page']) && $_POST['page'] == 'inscription') {
    $errors = [];
    if (isset($_POST['email'], $_POST['conf_email'], $_POST['password'], $_POST['conf_password'], $_POST['consentement']) && !empty($_POST['email']) && !empty($_POST['conf_email']) && !empty($_POST['password']) && !empty($_POST['conf_password']) && !empty($_POST['consentement'])) {
        $isChecked = $_POST['consentement'];
        $email = $_POST['email'];
        $conf_email = $_POST['conf_email'];
        $password = $_POST['password'];
        $conf_password = $_POST['conf_password'];

        $req = $pdo->prepare('SELECT * FROM user WHERE email = ?');
        $req->execute([$email]);
        $isUser = $req->fetch();

        if (!empty($isUser)) {
            array_push($errors, "Quelqu'un t'as volé ton adresse mail");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match(
                '/^[a-z]{1,}\.+[a-z]{1,}@laplateforme.io$/',
                $email
            )) {
            array_push($errors, "Le mail n'est pas au bon format (prenom.nom@laplateforme.io)");
        }
        if ($email != $conf_email) {
            array_push($errors, "Les mails ne sont pas les mêmes");
        }
        if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,30}/', $password)) {
            array_push($errors, "Le mot de passe n'est pas assez sécurisé");
        }
        if ($password != $conf_password) {
            array_push($errors, "Les mots de passe ne sont pas les mêmes");
        }
        if ($isChecked != 'true') {
            array_push($errors, "Le consentement est obligatoire pour s'inscrire");
        }
        if (empty($errors)) {
            $username = new PseudoAttribution($pdo);
            $secret_username = $username->SortPseudonymes();
            $password_hash = password_hash($password, PASSWORD_BCRYPT);
            $insertUser = $pdo->prepare('INSERT INTO user (email, password, consent, pseudonyme) VALUES (?,?,?,?)');
            $insertUser->execute([$email, $password_hash, true, $secret_username]);
            echo 'connexion';
        } else {
            echo json_encode($errors);
        }
    } else {
        array_push($errors, 'Veuillez remplir tous les champs');
        echo json_encode($errors);
    }
}
// Connexion
if (isset($_POST['page']) && $_POST['page'] == 'connexion') {
    $errors = [];
    if (isset($_POST['email'], $_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $req = $pdo->prepare('SELECT * FROM user WHERE email = ?');
        $req->execute([$email]);
        $isUser = $req->fetch();

        if (empty($isUser) || !password_verify($password, $isUser['password'])) {
            array_push($errors, 'Les identifiants sont incorrects');
        }
        if (empty($errors)) {
            $_SESSION['user'] = $isUser;
            $tab_session = [];

            array_push($tab_session, 'connecté');
            array_push($tab_session, $isUser);

            echo json_encode($tab_session);
        } else {
            $json = json_encode($errors);
            echo $json;
        }
    } else {
        array_push($errors, 'Veuillez remplir tous les champs');
        $json = json_encode($errors);
        echo $json;
    }
}
//Nombre participants
if (isset($_GET['p']) && $_GET['p'] == 'nombre_participants') {
    echo json_encode($pdo->query("SELECT COUNT(*) as number_users FROM user")->fetch());
}