
jQuery(document).ready(function() {

    $('.product-var-bookable').click(function() {

        var prodId = $(this).data('id');
        console.log(prodId);
        $.post(prodId);
        
    })

});

//AJAX Storing product ID and reloading page to run shortcode


jQuery(document).ready( function($) {
    
    setTimeout(function() {   //calls click event after a certain time
        $.ajax({
            url: "http://sushiexperience.com.test/",
            success: function() {
                alert( 'prod id is ' + prodId);
            }
        })
     }, 10000);

});