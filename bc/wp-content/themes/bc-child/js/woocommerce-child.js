jQuery(document).ready( function($) {

    /////////////////////////////////
    // AJAX FOR LOADING PRODUCT    
    /////////////////////////////////
    $('.product-var-bookable').on('click', function() {

        var prodID = $(this).data('id');

        $.ajax({
            type: 'POST',
            url: ajaxurl,
            dataType: 'html',
            data: { 
                action: 'get_product_shortcode',
                prodID : prodID
            },
            success: function(response){
                //console.log(response);

                var wrapper = $('.product-ajax-wrapper');

                wrapper.html(response);
       
            },
            complete: function(){
                loadVariationScript();
            },
            error : function() {
            }
        }); 
    
    });

    //load in woocommerce scripts on AJAX call for product
    function loadVariationScript() {
        console.log('scripts loaded');
        
        $.getScript("/bc/wp-content/plugins/woocommerce-bookings1/assets/js/booking-form.min.js");
        $.getScript("/bc/wp-content/plugins/woocommerce-bookings1/assets/js/date-picker.min.js");
        $.getScript("/bc/wp-content/plugins/woocommerce-bookings1/assets/js/month-picker.min.js");
    }
    /////////////////////////////////
    // END AJAX FOR LOADING PRODUCT    
    /////////////////////////////////

     /////////////////////////////////////
    // AJAX FOR RELOADING CART
    ////////////////////////////////////
    $('#wizard a.add_to_cart_button').on('click', function() {

        $.ajax({
            type: 'POST',
            url: ajaxurl,
            dataType: 'html',
            data: { 
                action: 'get_cart_shortcode'
            },
            success: function(response){

                console.log(response);
                var wrapper = $('.cart-ajax-wrapper');
                wrapper.html('');
                setTimeout(function(){ wrapper.html(response); }, 500);
       
            }
        }); 
    
    });
    /////////////////////////////////
    // END AJAX FOR LOADING CART   
    /////////////////////////////////

    /////////////////////////////////////
    // AJAX FOR RELOADING CHECKOUT  
    ////////////////////////////////////
    $('#wizard a').on('click', function() {

        $.ajax({
            type: 'POST',
            url: ajaxurl,
            dataType: 'html',
            data: { 
                action: 'get_checkout_shortcode'
            },
            success: function(response){

                var wrapper = $('.checkout-ajax-wrapper');

                wrapper.html(response);
       
            }
        }); 
    
    });
    /////////////////////////////////
    // END AJAX FOR LOADING CHECKOUT   
    /////////////////////////////////
});