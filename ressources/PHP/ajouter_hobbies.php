<?php
session_start();
require('../../classes/User.php');
require('../../classes/Database.php');
$db = new Database('noel_plateforme');
$pdo = $db->getPDO();

if (isset($_GET['p']) && $_GET['p'] == 'update_hobbies') {
    $user = new User($pdo);
    $user->addHobbies($_POST['hobby1'], $_POST['hobby2'], $_POST['hobby3']);
    $user_hobbies = $user->getHobbies();
    $hobbies[] = $user_hobbies["hobby1"];
    $hobbies[] = $user_hobbies["hobby2"];
    $hobbies[] = $user_hobbies["hobby3"];
    echo json_encode($hobbies);
}
