const tirage_date = new Date('December 3, 2020 12:00:00'); // A MODIFIER POUR TESTS
const Dday_date = new Date('December 3, 2020 13:00:00'); // A MODIFIER POUR TESTS

$(document).ready(function () {
    countdown(tirage_date);
});


function countdown(event_date) {
    var current_date = new Date();
    var total_secondes = (event_date - current_date) / 1000; // mettre le resultat en seconde
    // console.log(total_secondes);
    // Préparation des résultats et de la mise en page (affichage correct)
    var prefixe = "Compte à rebours terminé dans ";

    //Avant le tirage au sort
    if (total_secondes > 0) {
        if (current_date < tirage_date) {
            //$('#hobbies_child').addClass('d-none');
        }
        if (current_date < Dday_date) {
            //$('#bouton_pseudonyme').addClass('d-none');
        }

        // traitement qui nous interesse
        var jours = Math.floor(total_secondes / (60 * 60 * 24)); // arrondie au nombre entier
        var heures = Math.floor((total_secondes - (jours * 60 * 60 * 24)) / (60 * 60));
        var minutes = Math.floor((total_secondes - ((jours * 60 * 60 * 24 + heures * 60 * 60))) / 60);
        var secondes = Math.floor(total_secondes - ((jours * 60 * 60 * 24 + heures * 60 * 60 + minutes * 60)));

        $('#jours_register').html(jours);
        $('#heures_register').html(heures);
        $('#minutes_register').html(minutes);
        $('#secondes_register').html(secondes);
        if (current_date >= tirage_date) {
            setTimeout("countdown(Dday_date);", 1000);
        } else {
            setTimeout("countdown(tirage_date);", 1000);
        }

    } else if (total_secondes <= 0) {

        $('#form_hobbies_valider').addClass('d-none');
        $('.input_hobby').attr('disabled', '');
        $('.destinataire').addClass('d-none');
        $('.fa-check').addClass('d-none');
        $('#title_hobbies').html('Vos hobbies');
        // Avant le jour J
        // afficher la personne tiré au sort
        $.post(
            'ressources/php/countdown.php',
            {
                current_date: current_date,
                event_date: event_date
            },
            function (data) {
                var info_child = JSON.parse(data);

                if (info_child[0] == 'TirageauSort_check') {

                    if (!$('#hobbies_child').length) {
                        $('#profil_container').append('<div class="hobbies" id="hobbies_child">\n' +
                            '            <h2 class="text-align-center" id="pseudo_child">Faites un cadeau à </h2>\n' +
                            '            <ul class="flex-column justify-content-center">\n' +
                            '                <li class="text-align-center"><span id="child_hobby1">Centre d\'intérêt n°1</span></li>\n' +
                            '                <li class="text-align-center"><span id="child_hobby2">Centre d\'intérêt n°2</span></li>\n' +
                            '                <li class="text-align-center"><span id="child_hobby3">Centre d\'intérêt n°3</span></li>\n' +
                            '            </ul>\n' +
                            '        </div>');
                    }

                    $('#pseudo_child').html(`Faites un cadeau à <span class="font-goth darkblue-text">${info_child[1]['pseudonyme']}</span> ! Ses hobbies :`);

                    var hobby1 = info_child[1]['hobby1'];
                    var hobby2 = info_child[1]['hobby2'];
                    var hobby3 = info_child[1]['hobby3'];

                    var hobbies = {'#child_hobby1': hobby1, '#child_hobby2': hobby2, '#child_hobby3': hobby3};
                    $.map(hobbies, function (val, key) {
                        showHobbies(key, val);
                    });

                    // relance du countdown D_day
                    countdown(Dday_date);

                } else {
                    console.log('erreur tirage au sort day');
                }

                if (info_child[2] == 'JourJ_check') {
                    if (!$('#bouton_pseudonyme').length) {
                        pseudo = localStorage['pseudonyme'];
                        $('#bouton_container').append('<div id="bouton_pseudonyme" class="grid__item theme-2">\n' +
                            '            <p class="absolute">' + pseudo + '</p>\n' +
                            '            <button id="revelation_pseuso" class="particles-button relative z-index3">Découvre ton pseudonyme !</button>' +
                            '        </div>');
                        $('body').append('<script src="ressources/JS/anime.min.js"></script>\n' +
                            '<script src="ressources/JS/particles.js"></script>\n' +
                            '<script src="ressources/JS/demo.js"></script>');
                    }

                    $('#compte_a_rebours').addClass('d-none');
                    $('#h1_profil').addClass('d-none');
                    $('#info_pseudo').remove();

                } else {
                    console.log('erreur jour j event');
                }
            }
        );
    }
    $('.d-none').remove();
}

function showHobbies(selector, hobby) {
    if (hobby == '' || hobby == null) {
        hobby = 'Non renseigné';
    }
    $(selector).html(hobby);
}
