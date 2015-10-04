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

function redirecthome(number){
    deleteAllCookies();
    setCookie('movie',number,1);
    window.location = "./movies/";
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function deleteAllCookies() {
    var cookies = document.cookie.split(";");

    for (var i = 0; i < cookies.length; i++) {
    	var cookie = cookies[i];
    	var eqPos = cookie.indexOf("=");
    	var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
    	document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
    	
    }

}

    
