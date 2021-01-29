function inscription(){
        var checked_cons = $('#consentement').prop("checked");
        if (($('#email').val() != "" || $('#email').val() != null) && ($('#password').val() != "" || $('#password').val() != null) && ($('#conf_email').val() != "" || $('#conf_email').val() != null) && ($('#conf_password').val() != '' || $('#conf_password') != null) && (checked_cons === true || checked_cons === false)) {
            var email = $('#email').val();
            var conf_email = $('#conf_email').val();
            var password = $('#password').val();
            var conf_password = $('#conf_password').val();

            $.ajax(
                {
                    url: 'API/API_index.php',
                    type: 'POST',
                    data: {
                        email: email,
                        conf_email: conf_email,
                        password: password,
                        conf_password: conf_password,
                        consentement: checked_cons,
                        page: 'inscription'
                    },
                    success: (data) => {
                        $('#erreur_insc').html('');
                        if (data == 'connexion') {
                            $('#info_inscription').removeClass('info_none').addClass('info_flex').addClass('info_validation');
                            $('#info_inscription').html('Inscription prise en compte, veuillez patienter..');
                            timerRewrite('Views/connexion', 'main', 2500);
                        } else {
                            var error = JSON.parse(data);
                            for (let i = 0; i < error.length; i++) {
                                $('#erreur_insc').append(error[i] + '<br/>');
                            }
                            if (error[0] === 'Veuillez remplir tous les champs') {
                                $('input').addClass('nop');
                            }
                        }
                    }
                });
        }
}

$(function () {
    // Vérifie que le mail soit au format prenom.nom@laplateforme.io
    $('#email').keyup(function () {
        regexMailValide(this, 'nop', 'yep');
    });
    // Vérifie que les mails correspondent
    $('#conf_email').keyup(function () {
        isTheSame(this, $('#email'), 'nop', 'yep');
    });
    // Vérifie la sécurité du mot de passe
    $('#password').keyup(function () {
        regexPasswordValide(this, 'nop', 'yep');
    });
    // Vérifie que les mots de passe correspondent
    $('#conf_password').keyup(function () {
        isTheSame(this, $('#password'), 'nop', 'yep');
    });
    // Gère l'ajout de l'user dans la bdd ou l'affichage des messages d'erreurs
    $('#valid_insc').click(inscription);
    $(document).on('keypress',function(e) {
        if(e.which == 13) {
            inscription();
        }
    });
    $('#con_insc').click(function () {
        htmlRewrite('views/connexion', 'main');
    });
})
    