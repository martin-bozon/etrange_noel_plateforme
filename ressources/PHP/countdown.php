<?php
    session_start();
    require '../../classes/DateManager.php';
    require '../../classes/Database.php';
    require '../../classes/Sort.php';


    if(isset($_POST['current_date']) && isset($_POST['event_date'])){
        $tab_countdown = [];
        $inscription_date = 1606996800; // A MODIFIER POUR TESTS
        $d_day_date = 1607000400; // A MODIFIER POUR TESTS

        $datemanager = new DateManager($inscription_date, $d_day_date);
        $datemanager->isTirageausortDay();
        $datemanager->isJourJDay();

        if($datemanager->isTirageausortDay() == true){
            $db = new Database;
            $pdo= $db->getpdo();

            // faire tirage au sort
            $sort = new Sort($pdo);
            $sort->sort(); //return true si tirage au sort fait, return false si tirage déjà fait

            // arret inscription en js
            // afficher pseudo et hobbies de l'enfant de noel
            $id_santa = $_SESSION['user']['id_user'];

            $query = $pdo->prepare("SELECT id_enfant FROM papa_noel INNER JOIN user on id_papa_noel = id_user WHERE user.id_user = ?");
            $query->execute([$id_santa]);
            $info_santa = $query->fetch(PDO::FETCH_ASSOC);

            $query2 = $pdo->prepare("SELECT * FROM user WHERE id_user = ?");
            $query2->execute([$info_santa['id_enfant']]);
            $info_chil = $query2->fetch(PDO::FETCH_ASSOC);

            array_push($tab_countdown, 'TirageauSort_check');
            array_push($tab_countdown, $info_chil);

            // affichage de l'autre compte a rebours en js
        }else {
            array_push($tab_countdown, 'Sort_nope');
        }

        if($datemanager->isJourJDay() == true){
            // bouton 'découvrir pseudo'
            array_push($tab_countdown, 'JourJ_check');
            // affichage de son propre pseudo
        }else {
            array_push($tab_countdown, 'Not_jourj');
        }

        echo json_encode($tab_countdown);
    }else{
        echo 'prob sur post';
    }
