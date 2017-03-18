var animateSpeed = 500;
jQuery("#layout-controls a").click(function(){
           var folio = jQuery('#folio'),
         curClass = folio.attr('class'),
         newClass = jQuery(this).attr('class');
 
    folio.fadeOut(animateSpeed,function(){
        folio
                      .removeClass(curClass,animateSpeed)
          .addClass(newClass,animateSpeed);
    }).fadeIn(animateSpeed);
    return false;
});