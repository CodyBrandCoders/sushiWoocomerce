// Shuffle Array Function
function shuffle(array) {
  var currentIndex = array.length, temporaryValue, randomIndex;

  // While there remain elements to shuffle...
  while (0 !== currentIndex) {

    // Pick a remaining element...
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex -= 1;

    // And swap it with the current element.
    temporaryValue = array[currentIndex];
    array[currentIndex] = array[randomIndex];
    array[randomIndex] = temporaryValue;
  }

  return array;
}

$ = jQuery;

jQuery(document).ready(function($){

  // Any <a> tag that has href="#" will just do nothing
  $('a[href="#"]').click(function(e){
    e.preventDefault();
  });

  // Video Background Auto Play Function
  if($(".video-bg").length){
    $(".video-bg")[0].play();
  }

  // Setting Up Match Height Classes
  var matchHeightClasses = 4; // number of different matching height classes
  $(".match-height").matchHeight({ byRow: false });
  for(var i = 1;i <= matchHeightClasses; i++){
    console.log(".match-height-" + i);
    $(".match-height-" + i).matchHeight({ byRow: false });
  }
  // Match Height On Our Event System
  $(".event-details").matchHeight();

  // Scripts for our themes tabs
  $(".bc-tabs a").click(function(e){
    e.preventDefault();
    if($(this).hasClass('tab-active')){
      return;
    }else{
      var currentTab = $(".bc-tabs .tab-active");
      var currentPanel = $(".bc-tab-panels .panel-active");
      var newTab = $(this);
      var newPanel = $(".bc-tab-panels").find("[data-tab='" + newTab.data('toggle') + "']");
      currentTab.removeClass('tab-active');
      newTab.addClass('tab-active');
      currentPanel.removeClass('panel-active').fadeOut('fast',function(){
        newPanel.addClass('panel-active').fadeIn('fast');
      });
    }
  });

  // Contact Form Validation
  $(".wpcf7-captchar").addClass("wpcf7-validates-as-required");
  $(".contact-form input:not([type='submit']), .contact-form textarea").blur(function(){
    if($.trim($(this).val()) == '' && $(this).hasClass('wpcf7-validates-as-required')){
      $(this).css({
        'background-color': '#FFF0F0'
      });
    }else{
      $(this).css({
        'background-color' : '#F0FFF0'
      });
    }
  });

  //Vertically Center Bootstrap Modal
  (function ($) {
      "use strict";
      function centerModal() {
          $(this).css('display', 'block');
          var $dialog  = $(this).find(".modal-dialog"),
          offset       = ($(window).height() - $dialog.height()) / 2,
          bottomMargin = parseInt($dialog.css('marginBottom'), 10);

          // Make sure you don't hide the top part of the modal w/ a negative margin if it's longer than the screen height, and keep the margin equal to the bottom margin of the modal
          if(offset < bottomMargin) offset = bottomMargin;
          $dialog.css("margin-top", offset);
      }

      $(document).on('show.bs.modal', '.modal', centerModal);
      $(window).on("resize", function () {
          $('.modal:visible').each(centerModal);
      });
  }(jQuery));

  /* Scripts for Staff Ajax call */

  $(".staff-toggle").click(function(){
    var self = $(this);
    $(".bc-staff-grid .staff-toggle").removeClass("staff-toggle-active");
    $(this).addClass("staff-toggle-active");
    $.ajax({
      type : "GET",
      data : {id : $(this).data('staff-id')},
      dataType : "html",
      url : '/bc/wp-content/themes/bc/staffAjaxHandler.php',
      beforeSend : function(){
        self.parent().parent().siblings('.ajax-staff-data:visible').slideToggle();
      },
      success : function(data){
        self.parent().parent().nextAll('.ajax-staff-data:first').html(data)
        self.parent().parent().nextAll('.ajax-staff-data:first').slideToggle();
      },
      error: function(){

      }
    });
  });
  $(".staff-modal-toggle").click(function(){
    var self = $(this);
    $.ajax({
      type : "GET",
      data : {id : $(this).data('staff-id'), modal: true},
      dataType : "html",
      url : '/bc/wp-content/themes/bc/staffAjaxHandler.php',
      beforeSend : function(){
        $("#staffModal .modal-dialog").html('');
      },
      success : function(data){
        $("#staffModal .modal-dialog").html(data);
      },
      error: function(){

      }
    });
  });

  /* Scripts for Event Ajax call */

  $("#ajax-event-switch").click(function(e){
    e.preventDefault();
    $.ajax({
      type : "GET",
      data : {eventFilter : $(this).data('show')},
      dataType : "html",
      url : '/bc/wp-content/themes/bc/eventsAjaxHandler.php',
      beforeSend : function(){

      },
      success : function(data){
        $("#event-output").html(data);
      },
      error: function(){

      }
    });
    $(this).attr('data-show', 'upcoming');
  });

  // Search Form Toggles
  $(".primary-nav-search-toggle").click(function(){
    $(".primary-nav-search-form").slideToggle();
  });
  $(".mobile-nav-search").click(function(){
    if($(".mobile-nav-toggle").children('i').hasClass('fa-times')){
      $(".mobile-nav-toggle").children('i').toggleClass('fa-times fa-bars');
    }
    $(".mobile-nav-links").removeClass('active-menu');
    $(".mobile-nav-search-form").slideToggle('fast');
  });

  // Acoordion Setup
  $(".accordion-header a").click(function(e){
    var parent = $(this).parent().parent();
    var siblings = parent.siblings();
    e.preventDefault();
    if(parent.hasClass('active-accordion')){
      parent.removeClass('active-accordion');
      siblings.find('.accordion-content').slideUp();
      $(this).parent().next().slideToggle();
    }else{
      siblings.removeClass('active-accordion');
      parent.addClass('active-accordion');
      siblings.find('.accordion-content').slideUp();
      $(this).parent().next().slideToggle();
    }
  });

  // Calculating The Height Of Navbar If postiton: fixed
  $(".desktop-nav-wrap").css('height', $(".primary-nav").outerHeight(true));

  // Calculating The Height Of Mobile Navbar If postiton: fixed
  $(".mobile-nav-wrap").css('height', $(".mobile-nav").outerHeight(true));

  // Toggling The Mobile Nav Links When The Toggle Button Is Clicked
  $(".mobile-nav-toggle").click(function(e){
    e.preventDefault();
    $(this).children('i').toggleClass('fa-bars fa-times');
    $(".mobile-nav-search-form").css('display', 'none');
    $(".mobile-nav-links").toggleClass('active-menu');
  });

  // Checks if there is a .topbar and then adds postion:fixed after the topbar is out of sight
  if($(".topbar").length){
    var scrollPos = 0;
    $(document).scroll(function(){
      scrollPos = $(this).scrollTop();
      if(scrollPos > $(".topbar").outerHeight(true)){
        $(".primary-nav").addClass('fixed-top');
        if($(".primary-nav").hasClass("navbar-sit-over-banner")){
          $(".primary-nav").css('top', 0);
        }
      }else{
        $(".primary-nav").removeClass('fixed-top');
        if($(".primary-nav").hasClass("navbar-sit-over-banner")){
          $(".primary-nav").css('top', $(".topbar").outerHeight(true) - scrollPos);
        }
      }
      if(scrollPos > $(".desktop-nav-wrap").outerHeight(true)){
        $(".primary-nav-shrink").addClass('shrink-on-scroll');
      }else{
        $(".primary-nav-shrink").removeClass('shrink-on-scroll');
      }
    })
  }else{
    var scrollPos = 0;
    $(document).scroll(function(){
      scrollPos = $(this).scrollTop();
      if(scrollPos > $(".desktop-nav-wrap").outerHeight(true)){
        $(".primary-nav-shrink").addClass('shrink-on-scroll');
      }else{
        $(".primary-nav-shrink").removeClass('shrink-on-scroll');
      }
    })
  }

  // If the navbar has the style change module, add that class after the clear element
  if($('.primary-nav').hasClass('navbar-style-change')){
    var clearElement = $('.primary-nav').data('change');
    if($('.desktop-nav-wrap').length){
      $(document).scroll(function(){
        scrollPos = $(this).scrollTop();
        if(scrollPos > $(clearElement).outerHeight(true)){
          $(".primary-nav").addClass('navbar-style-change-active');
        }else{
          $(".primary-nav").removeClass('navbar-style-change-active');
        }
      })
    }else{
      $(document).scroll(function(){
        scrollPos = $(this).scrollTop();
        if(scrollPos > $(clearElement).outerHeight(true) - ($('.primary-nav').outerHeight(true))){
          $(".primary-nav").addClass('navbar-style-change-active');
        }else{
          $(".primary-nav").removeClass('navbar-style-change-active');
        }
      })
    }
  }

  // Forcing popup on share buttons instead of redirect
  $('.facebook-share, .twitter-share, .google-share, .linkedin-share').click(function(e) {
    e.preventDefault();
    window.open($(this).attr('href'), 'fbShareWindow', 'height=450, width=550, top=' + ($(window).height() / 2 - 275) + ', left=' + ($(window).width() / 2 - 225) + ', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');
    return false
  });

  // Adding a dropdown arrow for child pages
  $('.mobile-nav-links .menu-item-has-children > a').append('<i class="fa fa-angle-double-down"></i>');

  // Clicking dropdown icon on mobile causes sub menu to appear
  $('.mobile-nav-links .menu-item-has-children > a i').click(function(e){
    e.preventDefault();
    $(this).parent().siblings('.sub-menu').slideToggle();
  });

  // Affix nav setup and calculations
  $(".affix-page-nav").affix({
    offset: {
      top: $(".affix-page-nav").data('bc-offset'),
      bottom: function () {
        return (this.bottom = $('#footer-top').outerHeight(true))
      }
    }
  });

  // Smooth Scroll Setup
  $(".affix-page-nav a").smoothScroll({
    offset: -(60 + $(".affix-page-nav").outerHeight(true))
  });


  // Our mailchimp form ajax call
  $("#mailchimp-form-signup").submit(function(){
    var email = $(this).find('#mc-email').val();
    $.ajax({
      type : "GET",
      data : {email: email},
      dataType : "html",
      url : '/bc/wp-content/themes/bc/mailchimpAjaxHandler.php',
      success : function(data){
        window.location.href = '/';
      },
      error: function(err){
        alert('Something has gone wrong');
      }
    });
    return false;
  });

  // Reviews List Animation
  $(".review-link-grid .block-grid-item").each(function(index){
    var row = $(this);
    setTimeout(function(){
      row.css({
        opacity: 1,
        transform: 'rotate(0deg)'
      })
    }, index * 300);
  });

  // Theme Animation Classes
  $(".text-fade").waypoint(function(){
    $(this.element).addClass('bc-anim-active');
    this.destroy();
  }, {offset: '95%', triggerOnce: true});

  $(".bc-fade-in-left, .bc-fade-in-right").waypoint(function(){
    $(this.element).addClass('bc-anim-active');
    this.destroy();
  }, {offset: '90%', triggerOnce: true});

  // Block Grid Animations

  /* random pop */
  $(".block-grid-random-pop").waypoint(function(){
    var children = shuffle($(this.element).children('.block-grid-item'));
    $(children).each(function(index) {
     var self = $(this);
     setTimeout(function(){
       self.css({
         'opacity': 1,
         'transform' : 'scale(1)',
         '-webkit-transform' : 'scale(1)',
         '-ms-transform' : 'scale(1)'
       });
     }, index * 150);
    });
    this.destroy();
  }, {offset: '90%', triggerOnce: true});

  /* pop */
  $(".block-grid-pop").waypoint(function(){
    var children = $(this.element).children('.block-grid-item');
    $(children).each(function(index) {
      var self = $(this);
      setTimeout(function(){
        self.css({
          'opacity': 1,
          'transform' : 'scale(1)',
          '-webkit-transform' : 'scale(1)',
          '-ms-transform' : 'scale(1)'
        });
      }, index * 150);
    });
    this.destroy();
  }, {offset: '90%', triggerOnce: true});

  /* all-pop */
  $(".block-grid-all-pop").waypoint(function(){
    var children = $(this.element).children('.block-grid-item');
    $(children).css({
      'opacity': 1,
      'transform' : 'scale(1)',
      '-webkit-transform' : 'scale(1)',
      '-ms-transform' : 'scale(1)'
    });
    this.destroy();
  }, {offset: '90%', triggerOnce: true});

  /* slide */
  $(".block-grid-slide").waypoint(function(){
    var children = $(this.element).children('.block-grid-item');
    $(children).each(function(index) {
      var self = $(this);
      setTimeout(function(){
        self.css({
         'opacity': 1,
         'transform' : 'translateX(0)',
         '-webkit-transform' : 'translateX(0)',
         '-ms-transform' : 'translateX(0)'
        });
      }, index * 300);
    });
    this.destroy();
  }, {offset: '90%', triggerOnce: true});

  /* up-down */
  $(".block-grid-up-down").waypoint(function(){
    var children = $(this.element).children('.block-grid-item');
    $(children).each(function(index) {
      var self = $(this);
      setTimeout(function(){
        self.css({
          'opacity': 1,
          'transform' : 'translateY(0)',
          '-webkit-transform' : 'translateY(0)',
          '-ms-transform' : 'translateY(0)'
        });
      }, index * 200);
    });
    this.destroy();
  }, {offset: '90%', triggerOnce: true});

  /* fade-spin */
  $(".block-grid-fade-spin").waypoint(function(){
    var children = $(this.element).children('.block-grid-item');
    $(children).each(function(index) {
      var self = $(this);
      setTimeout(function(){
        self.css({
          'opacity': 1,
          'transform' : 'rotate(0deg) translateY(0)',
          '-webkit-transform' : 'rotate(0deg) translateY(0)',
          '-ms-transform' : 'rotate(0deg) translateY(0)'
        });
      }, index * 200);
    });
    this.destroy();
  }, {offset: '90%', triggerOnce: true});

  $(".bc-counter").waypoint(function(){
    var el = $(this.element);
    var num = el.data('number');
    $(el).children('span').countTo({
      from: 0,
      to: num,
      speed: 1000
    });
    this.destroy();
  }, {offset: '95%', triggerOnce: true});

});
// // Toggle The Admin Bar on Keystroke
// $(document).bind('keypress', function(event) {
//     if( event.which === 90 && event.shiftKey ) {
//         $("#wpadminbar").toggle();
//     }
// });

$(window).scroll(function() {

    if ($(this).scrollTop()>0)
     {
        $('.header-social-icons').fadeOut();
     }
    else
     {
      $('.header-social-icons').fadeIn();
     }
 });
