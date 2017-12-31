/* main.js bava.cms */

$(document).ready(function(){
//alert('!!!!');
    $(window).scroll(function() {
        if ($(this).scrollTop() > 300) {
            if ($('#upbutton').is(':hidden')) {
                $('#upbutton').css({opacity : 1}).fadeIn('slow');
            }
        } else { 
        	$('#upbutton').stop(true, false).fadeOut('fast'); 
        }
    });
    $('#upbutton').click(function() {
        $('html, body').stop().animate({scrollTop : 0}, 500);
    });
        
  
    $(".menu-but").click(function(){            
        $(".menu-but").css("display", "none");   
        $(".head1").css("display", "block");
    }); 
    $(".head1").click(function(){            
        $(".menu-but").css("display", "block");   
        $(".head1").css("display", "none");
    }); 

});


