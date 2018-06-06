jQuery(document).ready( function($) {


    //enabled tooltips
    $('.tooltip-container').tooltip();

    //MOVE THROUGH FORM
    $('.product-var-bookable, .next-step ').on('click', function() {
        $("#wizard").steps('next');
    });

    //disable addons after click
    $('#sushi-bookable-item .product_type_simple.add_to_cart_button').on('click', function() {
        $(this).addClass('active');
    });
    //reenable product addon if its removed from cart
    $('.cart-addons').on('click', '.cart-remove-addon', function() {

        //console.log('clicked to make not active');
        var removableItemId = $(this).data('id');
       // console.log(removableItemId);
       // console.log('a[data-product_id="' + removableItemId + '"]');
        $('.current').find('[data-product_id="' + removableItemId + '"]').removeClass('active');
    });

    //Reset Flex on main page 
    setTimeout(function(){
        $('.page-template-template-shop #sushi-bookable-item h2').css('margin-bottom', 0);
    }, 2000);

    //reset flex on element size changes from calander
    new ResizeSensor(jQuery('.content-bookable-item'), function(){ 
        setTimeout(function(){
            $('.page-template-template-shop .products #sushi-bookable-item .content-bookable-item').css('flex-grow', '2');
        }, 1000);
        $('.page-template-template-shop .products #sushi-bookable-item .content-bookable-item').css('flex-grow', '1');
    });

    //Allow contintue only after date has been selected
    $(".booking_date_day").on('propertychange change keyup input paste', function(){
        $(this).closest('#sushi-bookable-item').find('div.tooltip-container').css('height', '0');
      });

    ////////////////////////////////////////////////////
    // ENSURE THERE ARE NEVER MORE THAN ONE EXPERIENCE 
    ///////////////////////////////////////////////////
    $('#wizard-t-0, .section-package #sushi-bookable-item #wc_bookings_field_persons').on('click', function() {

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
                $('.package-calc .package-price').html('');
                $('.package-calc .package-price').attr('data-id',data['']);
                $('.package-calc .package-title').html('');
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
        $('.sushi-value-input').val(sushiVal);
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
    //setTimeout(function(){

        packageTotal ='';
        packageTotal = $('.current .col-flex .package-price').attr('data-id');
        packageTotal = Number(packageTotal);
        console.log(packageTotal);

        //GET DATA FROM ALL CHILDREN(ADDONS)
        var addonArray =[];
        $('.current .col-flex .addon-item.product-simple').each(function(i,item) {
            addonArray.push($(item).data('price'));
        });

        var addonTotal = addonArray.reduce(function (a,b){
            return a + b;
        }, 0);
        console.log(addonArray);
        console.log(addonTotal);
        var addTotal = (packageTotal + addonTotal);

        if(addonTotal <= 0) {
            console.log('Its 0');
            console.log(packageTotal);
            sushiTotal = packageTotal * sushiVal;
        } else {
            console.log('Its greater than 0');
            sushiTotal = addTotal * sushiVal;
            console.log(sushiTotal);

        }

        $('.sushie-value-total').html(sushiTotal);
    //}, 500);
}