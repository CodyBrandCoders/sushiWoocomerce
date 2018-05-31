jQuery(document).ready( function($) {

    //MOVE THROUGH FORM
    $('.product-var-bookable, .next-step ').on('click', function() {
        $("#wizard").steps('next');
    });

    //disable addons after click
    $('#sushi-bookable-item .product_type_simple.add_to_cart_button').on('click', function() {
        $(this).addClass('active');
    });

    /////////////////////////////////
    // AJAX FOR LOADING PRODUCT    
    /////////////////////////////////
    $('.product-var-bookable').on('click', function() {

        var prodID = $(this).data('id');

        $.ajax({
            type: 'POST',
            url: ajaxurl,
            dataType: 'JSON',
            data: { 
                action: 'get_product_shortcode',
                prodID : prodID
            },
            success: function(data){
                //console.log(data);

                $('.product-ajax-wrapper').html(data['data_1']);
                $('.cart-addons').html();
                $('.cart-addons').html(data['data_2']);
                //reload Calculator
                reloadCalc();
       
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
    // AJAX FOR PRICE AND TITLE IN CART
    ////////////////////////////////////
    $('.product-var-bookable').on('click', function() {

        var prodID = $(this).data('id');

        $.ajax({
            type: 'POST',
            url: ajaxurl,
            dataType: 'JSON',
            data: { 
                action: 'get_checkout_price',
                prodID : prodID
            },
            success: function(data){
                //console.log('title is ' + data['title'] + ' and the cost is ' + data['price']);

                $('.package-price').html(data['price']);
                $('.package-price').attr('data-id',data['price']);
                $('.package-title').html(data['title']);
                //reload Calculator
                reloadCalc();
       
            }
        }); 
    
    });
    /////////////////////////////////
    // END AJAX FOR LOADING CART   
    /////////////////////////////////



    /////////////////////////////////////
    // AJAX FOR REMOVING ADDONS IN CART
    ////////////////////////////////////
    $('.cart-addons').on('click', '.cart-remove-addon', function(event) {
        event.preventDefault();

        var addonID = $(this).data('id');
        console.log(addonID);

        $.ajax({
            type: 'POST',
            url: ajaxurl,
            dataType: 'HTML',
            data: { 
                action: 'remove_addon',
                addonID : addonID
            },
            success: function(response){
                $('.cart-addons').html();
                $('.cart-addons').html(response);
                //reload Calculator
                reloadCalc();
            }
        }); 
    
    });
    /////////////////////////////////////
    // END AJAX FOR LOADING CART   
    /////////////////////////////////////
    /////////////////////////////////////
    // AJAX FOR ADDONS IN CART
    /////////////////////////////////////
    $('.add_to_cart_button').on('click', function(event) {
        event.preventDefault();
        setTimeout(function(){
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                dataType: 'HTML',
                data: { 
                    action: 'get_addons'
                },
                success: function(response){
        
                    $('.cart-addons').html('');
                    $('.cart-addons').html(response);
                    //reload Calculator
                    reloadCalc();
        
                }
            }); 
        }, 1000);
    
    });
    /////////////////////////////////
    // END AJAX FOR LOADING CART   
    /////////////////////////////////

    /////////////////////////////////////
    // AJAX FOR RELOADING CHECKOUT  
    ////////////////////////////////////
    $('#wizard, .product-var-bookable').on('click', function() {

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

    /////////////////////////////////////
    // JS FOR SAVING INPUT VALUE
    /////////////////////////////////////
    
    //var sushiVal = $('.sushi-value').val();

    $('.sushi-value').on("change keyup paste", function(){
        sushiVal = $(this).val();
        //console.log('value is ' + sushiVal);
        $('.sushi-value-input').val(sushiVal);
    });

    /////////////////////////////////////
    // JS FOR CALCULATOR
    /////////////////////////////////////

    $('.sushi-value-input').on("change keyup paste", function(){
        //reload Calculator
        reloadCalc();
    });

    function reloadCalc() {
       // setTimeout(function(){

            packageTotal ='';
            packageTotal = $('.col-flex .package-price').attr('data-id');

            //GET DATA FROM ALL CHILDREN(ADDONS)
            var addonArray =[];
            $('.addon-item').each(function(i,item) {
                addonArray.push($(item).data('price'));
            });

            var addonTotal = addonArray.reduce(function (a,b){
                return a + b;
            }, 0);

            console.log(addonTotal);
            var addTotal = (packageTotal + addonTotal);

            if(addonTotal <= 0) {
                console.log('Its 0');
                console.log(packageTotal);
                sushiTotal = packageTotal * sushiVal;
            } else {
                console.log('Its greater than 0');
                sushiTotal = addTotal * sushiVal;
            }

            $('.sushie-value-total').html(sushiTotal);
        //}, 500);
    }
});