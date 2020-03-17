    $('.description').hide();



    $('.caveBottle1').on('click', function() {
    $(this).next().toggle();
    $(this).not().next().siblings('.description').hide();
});

