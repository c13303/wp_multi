

jQuery(document).ready(function ($) {

    console.log('heures by charles torris');

    $('.monloadmore').html('Photos suivantes');

    $('body').on('hover', '.photocontainer', function () {

       /* $('.legend').hide();
        $(this).find('.legend').show();*/
    });

    $('body').on('click', '.photocontainer', function () {
        var large = $(this).data('large');
        $.featherlight({image: large});
    });
    
    
    $('.wp-activate-container .view').html('Votre compte est maintenant activé. Rendez vous sur <a href="/upload"> l\'espace publication </a> pour vous connecter.')
});
