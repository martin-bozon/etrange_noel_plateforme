function connexion() {
    if (($('#email_con').val() != "" || $('#email_con').val() != null) && ($('#password_con').val() != "" || $('#password_con').val() != null)) {
        let email = $('#email_con').val();
        let password = $('#password_con').val();

        $.ajax(
            {
                url: 'API/API_index.php',
                type: 'POST',
                data: {email: email, password: password, page: 'connexion'},
                success: (data) => {
                    console.log(data);
                    var info_result = JSON.parse(data);
                    console.log(info_result);
                    if (info_result[0] === 'connecté') {
                        localStorage.setItem('id_user', info_result[1]['id_user']);
                        localStorage.setItem('email', info_result[1]['email']);
                        localStorage.setItem('hobby1', info_result[1]['hobby1']);
                        localStorage.setItem('hobby2', info_result[1]['hobby2']);
                        localStorage.setItem('hobby3', info_result[1]['hobby3']);
                        localStorage.setItem('pseudonyme', info_result[1]['pseudonyme']);


                        $('input').removeClass('nop').addClass('yep');
                        $('#errur_con').remove();
                        $('#msg-connect').removeClass('info_none').addClass('info_flex').addClass('info_validation');
                        $('#msg-connect').html('Connexion...');
                        timerRedirect('profil.php', 1500);
                    } else {
                        let error = JSON.parse(data);
                        for (let i = 0; i < error.length; i++) {
                            $('#erreur_con').html(error[i]);
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
    $('#insc_con').click(function () {
        htmlRewrite('views/inscription', 'main');
    });
    $('#valid_con').click(connexion);
    $(document).on('keypress',function(e) {
        if(e.which == 13) {
            connexion();
        }
    });
})