jQuery(function ($) {

    $(".cart-btn").click(function(e){

        var url = $(e.currentTarget).data('url');
        $(e.currentTarget).prop("disabled",true);
        $.post( url )
            .done(function(ret) {
                console.log(ret);
                alert('Vous avez un nouvel item dans votre panier');
            })
            .fail(function() {
                alert( "error" );
            })
            .always(function() {
                $(e.currentTarget).prop("disabled",false);
            });
    });
});
