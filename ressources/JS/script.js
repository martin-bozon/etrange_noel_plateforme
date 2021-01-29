$(function () {
    $('#inscription').click(function (e) {
        $("header").removeClass("header_index");
        $("header").addClass("header_general");
        htmlRewrite('views/inscription', 'main');
    });
    $('#connexion').click(function (e) {
        e.preventDefault();
        $("header").removeClass("header_index");
        $("header").addClass("header_general");
        htmlRewrite('views/connexion', 'main');
    });

    $.ajax(
        {
            url: 'API/API_index.php?p=nombre_participants',
            dataType : "json",
            success: (data) => {
                $('#nombre_participants').html(`${data.number_users} plateformeurs`);
            }
        });
    $('.d-none').remove();
})
