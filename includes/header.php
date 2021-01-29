<?php
if (isset($_SESSION['user'])) {
    $user = explode('@', $_SESSION['user']['email']);
    $username = explode('.', $user[0]);
}
?>
<header class="header_index">
    <div class="flex-row align-items-center">
        <a class="flex-1" href="index.php"><i class="hover-gold fas fa-home"></i></a>
        <h1 class="flex-2 text-align-center mx-1">L'étrange Noël de La Plateforme_</h1>
        <div class="flex-1 flex-row align-items-center justify-content-flexend" id="info_user_header">
            <div class="<?= isset($_SESSION['user']['id_user']) ? '' : 'd-none' ?>" id="profil_header">
                <a href="profil.php" class="flex-row align-items-center"><span
                            class="mx-05 hover-gold"><?= ucfirst($username[0]) ?> <?= ucfirst($username[1]) ?></span><i
                            class="fas fa-id-card hover-gold"></i></a>
            </div>
            <a href="includes/deconnexion.php" class="<?= isset($_SESSION['user']['id_user']) ? '' : 'd-none' ?>"
               id="deconnexion_header"><i class="fas fa-power-off hover-red"></i></a>
            <a id="connexion" class="<?= !isset($_SESSION['user']['id_user']) ? '' : 'd-none' ?>"><i
                        class="fas fa-user-circle hover-gold"></i></a>
        </div>
    </div>
</header>

