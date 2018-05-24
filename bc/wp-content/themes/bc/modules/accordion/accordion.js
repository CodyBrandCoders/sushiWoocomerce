var $ = jQuery;
$(document).ready(function(){
  $(".accordion-header a").click(function(e){
    var parent = $(this).parent().parent();
    var siblings = parent.siblings();
    e.preventDefault();
    siblings.removeClass('active-accordion');
    parent.addClass('active-accordion');
    if(parent.hasClass('active-accordion')){
      siblings.find('.accordion-content').slideUp();
      $(this).parent().next().slideToggle();
    }
  })
});
