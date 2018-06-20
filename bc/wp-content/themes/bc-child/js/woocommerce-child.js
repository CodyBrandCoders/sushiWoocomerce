jQuery(document).ready( function($) {
    //MOVE THROUGH FORM
    $('.product-var-bookable, .next-step ').on('click', function() {
        $("#wizard").steps('next');
    });
    $('.change-party-number').on('click', function() {
        $("#wizard").steps('previous');
        reloadCalc();
    });

    //reenable product addon if its removed from cart
    $('.cart-addons').on('click', '.cart-remove-addon', function() {
        var removableItemId = $(this).data('id');
        $('.current').find('[data-product_id="' + removableItemId + '"]').removeClass('active');
    });

    //Reset Flex on main page 
    setTimeout(function(){
        $('.page-template-template-shop #sushi-bookable-item .content-bookable-item').css('margin-bottom', 0);
    }, 500);

    //reset flex on element size changes from calander
    new ResizeSensor(jQuery('.content-bookable-item'), function(){ 
        setTimeout(function(){
            $('.page-template-template-shop .products #sushi-bookable-item .content-bookable-item').css('flex-grow', '2');
        }, 1000);
        $('.page-template-template-shop .products #sushi-bookable-item .content-bookable-item').css('flex-grow', '1');
    });

    //Allow contintue only after date has been selected
    $("#sushi-bookable-item #wc_bookings_field_persons").on('propertychange change keyup input paste', function(){
        $(this).closest('#sushi-bookable-item').find('a.product-var-bookable').css('opacity', '1').css('pointer-events', 'all');
    });
    $(".wc-bookings-date-picker-choose-date").on('click', function(){
        $(this).closest('#sushi-bookable-item').find('div.sushi-party-size').toggleClass('active');
    });

    ////////////////////////////////////////////////////
    // ENSURE THERE ARE NEVER MORE THAN ONE EXPERIENCE 
    ///////////////////////////////////////////////////
    $('#wizard-t-0, .change-party-number, .wc-bookings-date-picker-choose-date').on('click', function() {

        $.ajax({
            type: 'POST',
            url: ajaxurl,
            dataType: 'HTML',
            data: { 
                action: 'empty_cart'
            },
            success: function(data){
                //console.log(data);
                //reload Calculator

                //This removes everything aside from addons
                $('.package-calc .package-price').html('');
                $('.package-calc .package-price').attr('data-id',data['']);
                $('.package-calc .package-title').html('');
                $('.booking_date_day').val('');
                $('.block-picker li').remove();
                $('.wc-bookings-booking-cost').css('display', 'none');
                $('#wizard-t-*').parent().removeClass('done');
                $('#wizard-t-*').parent().addClass('disabled');
                reloadCalc();
            }
        });
    });
    /////////////////////////////////
    // END AJAX FOR LOADING PRODUCT    
    /////////////////////////////////

     /////////////////////////////////////
    // AJAX FOR PRICE AND TITLE IN CART
    ////////////////////////////////////
    $('.product-var-bookable').on('click', function() {

        var prodID = $(this).data('id');
        console.log('clicked' + prodID);

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

                //console.log(data);
                 $('.package-calc .package-price').html(data['price']);
                 $('.package-calc .package-price').attr('data-id',data['price']);
                 $('.package-calc .package-title').html(data['title']);
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
        //console.log(addonID);

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

    $('.sushi-bookable-item-wrapper').on('click','.product_type_simple.add_to_cart_button.active', function(e) {
        e.preventDefault();
        

        var addonID = $(this).data('product_id');

        var $this = $(this);

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
                $this.removeClass('active');
                $this.addClass('ajax_add_to_cart');
                $this.closest('#sushi-bookable-item').find('.minus-addon-circle').css('display', 'none');
                $this.closest('#sushi-bookable-item').find('.add-addon-circle').removeClass('active');
                //reload Calculator
                reloadCalc();
            }
        }); 
    
    });

    /////////////////////////////////////
    // END AJAX FOR REMOVING ADDONS   
    /////////////////////////////////////
    /////////////////////////////////////
    // AJAX FOR ADDONS IN CART
    /////////////////////////////////////
    $('.sushi-bookable-item-wrapper').on('click','.ajax_add_to_cart', function(event) {
        event.preventDefault();
        
        var addonAmmount = $(this).closest('#sushi-bookable-item').find('div.addon-price-wrapper .quantity input').val();
        console.log('value for addon is ' + addonAmmount);
        var addonID = $(this).data('product_id');

        var $this = $(this);
        setTimeout(function(){
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                dataType: 'HTML',
                data: { 
                    action: 'get_addons',
                    addonID : addonID,
                    addonAmmount : addonAmmount
                },
                success: function(response){
        
                    $('.cart-addons').html('');
                    $('.cart-addons').html(response);
                    $this.addClass('active');
                    $this.removeClass('ajax_add_to_cart');
                    $this.closest('#sushi-bookable-item').find('.minus-addon-circle').css('display', 'inline-block');
                    $this.closest('#sushi-bookable-item').find('.add-addon-circle').addClass('active');
                    //reload Calculator
                    reloadCalc();
        
                }
            }); 
        }, 500);
    
    });
    /////////////////////////////////
    // END AJAX FOR LOADING CART   
    /////////////////////////////////

    /////////////////////////////////////
    // AJAX FOR RELOADING CHECKOUT  
    ////////////////////////////////////
    $('.next-step, .product-var-bookable').on('click', function() {

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
                reloadCalc();
       
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
    sushiVal = 1;

    $('.sushi-value').on("change keyup paste", function(){
        sushiVal = $(this).val();
        //console.log('value is ' + sushiVal);
        $('.sushi-value-input').html(sushiVal);
        $('#wc_bookings_field_persons').val(sushiVal);
        reloadCalc();
    });

    /////////////////////////////////////
    // JS FOR CALCULATOR
    /////////////////////////////////////

    $('.sushi-value-input').on("change keyup paste", function(){
        //reload Calculator
        reloadCalc();
    });

    $('.product-var-bookable').click(function( event ) {
        event.preventDefault();
        var formData = $(this).closest('#sushi-bookable-item').find('form').serializeArray();
        var data = {'action': 'custom_add_to_cart'};
        var fixedArray = objectifyForm(formData);
        var result={};
        // using jQuery extend
        $.extend(result, data, fixedArray);

        console.log(formData, result);

        $.ajax({
            type: 'POST',
            url: ajaxurl,
            dataType: 'html',
            data: result,
            success: function(response){
                console.log('return:', response);
                reloadCalc();
            }
        });
    });
});

//serialize data function
function objectifyForm(formArray) {

var returnArray = {};
for (var i = 0; i < formArray.length; i++){
  returnArray[formArray[i]['name']] = formArray[i]['value'];
}
return returnArray;

}
function reloadCalc() {
        packageTotal ='';
        packageTotal = $('.current .col-flex .package-price').attr('data-id');
        packageTotal = Number(packageTotal);
        console.log('package total is ' + packageTotal);

        //GET DATA FROM ALL CHILDREN(ADDONS)
        var addonArray =[];
        $('.current .col-flex .addon-item.product-simple').each(function(i,item) {
            var addonamm = $(this).data('ammount');
            var addonprice = $(this).data('price');
            var addonitemtotal = addonamm * addonprice;
            addonArray.push(addonitemtotal);
        });

        var addonTotal = addonArray.reduce(function (a,b){
            return a + b;
        }, 0);
        console.log(addonArray);
        console.log(addonTotal);
        var addTotal = (packageTotal + addonTotal);

        if(addonTotal <= 0 || null) {
            console.log('Its 0');
            console.log(packageTotal);
            sushiTotal = packageTotal * sushiVal;
        } else {
            console.log('Its greater than 0');
            sushiTotal = addonTotal + packageTotal * sushiVal;
            console.log(sushiTotal);

        }

        $('.sushie-value-total').html(sushiTotal);
}