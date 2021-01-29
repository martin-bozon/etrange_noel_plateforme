function checkHobbies(hobby, checkhobby){
    if (($(hobby).val()) !== '' && ($(hobby).val) !== null){
        $(checkhobby).addClass('green-text');
    } else{
        $(checkhobby).removeClass('green-text');
        $(hobby).attr('placeholder', 'Non renseigné');
    }
}

$(function () {
    $("#form_hobbies").submit(function (e) {
        e.preventDefault();

        var hobby1 = $("#hobby1").val();
        var hobby2 = $("#hobby2").val();
        var hobby3 = $("#hobby3").val();

        $.ajax({
            url: 'ressources/PHP/ajouter_hobbies.php?p=update_hobbies',
            type: 'POST',
            dataType: 'json',
            data: {
                hobby1: hobby1,
                hobby2: hobby2,
                hobby3: hobby3
            },
            success: () => {
                var hobbies = { '#hobby1': '#check_hobby1', '#hobby2': '#check_hobby2', '#hobby3': '#check_hobby3' };
                $.map( hobbies, function(val, key) {
                    checkHobbies(key, val);
                });
            }
        });
    })
})
