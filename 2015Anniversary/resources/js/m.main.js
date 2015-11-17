function addSide(){
        $(location).attr('href').match(/([a-zA-Z\-\_0-9]+\.\w+)$/);
        var current_path = window.location.pathname.split('/').pop();
        function whiteSide(thisTop, thisH){
                $('body').append( "<div class='whiteSideL'></div><div class='whiteSideR'></div>");
                var whiteSideTop=$(thisTop).height();
                var whiteSideH=$(thisH).height()+$('#copyright').height()+24;
                var whiteSideW=($(window).width()-960)/2;
                $('.whiteSideL, .whiteSideR').css({"top":whiteSideTop+"px","height":whiteSideH+"px", "width":whiteSideW+"px"});
            }
        if(current_path== 'm.index.html'||current_path== 'm.index.html#'){            
            whiteSide('#kv', '#prize');
        }
        if(current_path== 'm.final.html'||current_path== 'm.final.html#'){
            whiteSide('#share', '#app');
        }
    }
$(document).ready(function() {    
    
    $(window).resize(function(){
        if($(window).width()>=960){
            addSide();    
        }else{
           $('.whiteSideL, .whiteSideR').remove();
        }
    });
    $('a[href^="#"]').on('click', function(event) {

        var target = $($(this).attr('href'));

        if (target.length) {
            event.preventDefault();
            $('html, body').animate({
                scrollTop: target.offset().top
            }, 1000);
        }

    });
});
$(window).load(function(){
	window.scrollTo(0,1);
    if($(window).width()>=960){
            addSide();    
        }else{
           $('.whiteSideL, .whiteSideR').remove();
     }
});