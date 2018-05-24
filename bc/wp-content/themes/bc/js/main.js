jQuery(document).ready(function($){
  // Slideshow Init
  // See documentation for more options => http://kenwheeler.github.io/slick/
  $('.bc-slideshow').slick({
    dots: true,
    infinite: true,
    cssEase: 'linear',
    slidesToShow: 1,
    arrows: true,
    dots: false,
    adaptiveHeight: true
  });
  $('.bc-image-slider').slick({
    dots: true,
    infinite: true,
    cssEase: 'linear',
    slidesToShow: 1,
    arrows: false,
    dots: false,
    fade: true,
    autoplay: true,
    autoplaySpeed: 3000,
    speed: 1000,
    adaptiveHeight: true
  });
  //AOS Animate on Scroll Init
  AOS.init();
  /*===============================
    Start Document.Ready Website Scripts
   ===============================*/

});

/*===============================
  Start General Website Scripts
 ===============================*/

//Contact Form 7 Success Redirect ALL FORMS to SINGLE Thank-You page
// document.addEventListener( 'wpcf7mailsent', function( event ) {
//     location = '/contact/thank-you/';
// }, false );

// // Contact Form 7 Success Redirect SEPARATE FORMS to SEPARATE Thank-You page
document.addEventListener( 'wpcf7mailsent', function( event ) {
    if ( '2909' == event.detail.contactFormId ) {
      // Sends submissions to separate Thank-You page
      location = '/book-now/thank-you/';
    } else if ( '2377' == event.detail.contactFormId ) {
      // Sends submissions to separate Thank-You page
      location = '/contact/thank-you/';
    } else if ( '1221' == event.detail.contactFormId ) {
      // Sends submissions to separate Thank-You page
      location = '/contact/thank-you/';
    }

//      else if ( '1221' == event.detail.contactFormId ) {
//       // Sends submissions to separate Thank-You page
//       location = '/orlando-private-party-venue/thank-you/';
//     } else {
//       // Sends submissions to DEFAULT Thank-You page
//       location = '/contact/thank-you/';
//     }
}, false );