// JQuerry Starts Here  
$(document).ready(function(){
    
    $(window).scroll(function() {
        if ($(window).scrollTop() > 250) {
            $('header').addClass('magic');
        } else {
            $('header').removeClass('magic');
        }
    });
    
    $('a[href^="./#"]').on('click', function(event) {
    var target = $(this.href);
    if( target.length ) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: target.offset().top
        }, 1000);
    }
});

$("nav ul .mobile").click(function(){
        $("nav.mobile").toggleClass('show');
    });
    
});
// JQuerry ends here 