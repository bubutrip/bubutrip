function bigImg(){
	$('body').find('img').width("100%");
	$('body').css({"font-size":"1em"});
	$('.scroll-pane, .voucherBox').css({"font-size":"1em", "line-height": "1.8em"});
	$('#bgPiank').css({"top":"25%"});
	$('#scrollBox').css({"bottom":"5%"});
	$('.inBox1').css({"left":"35px","top":"200px"});
	$('.inBox1 p').css({"width":"100%"});
	$('.inBox2').css({"right":"40px","top":"145px"});
	$('.inBox2 p').css({"top":"290px","right":"55px"});
	$('.inBox1 p').css({"width":"100%"});
	$('.inTitle').css({"left":"30px","top":"50px"});
	$('.inTitleLogo').css({"left":"145px"});
	$('.inSquirrel').css({"right":"300px"});
	$('.inActivity').css({"right":"160px"});
	$('.inPrize').css({"right":"40px"});
	$('.registerBtn').css({"right":"70px"});
	$('.conBox1').css({"top":"-180px","right":"-5px"});
	$('.prize1').css({"top":"300px","right":"0"});
	$('.prize2').css({"top":"110px","left":"-100px"});
	$('.conBox2').css({"top":"-85px"});
	$('.conBoxT').css({"right":"-220px"});
	$('.goNameBtn').css({"bottom":"320px","left":"240px"});
	$('.squirrelDialog').css({"top":"-20px","left":"-270px"});
	$('.squirrelDialog p').css({"top":"40px","left":"35px"});
	$('.touchMe').css({"top":"-30px","right":"-75px"});
	$('.activityBox').css({"top":"-280px"});
	$('#activity > div.activityTxt').css({"width":"1192px","margin-left":"-596px"});
	$('.actFL div.actImg').css({"margin":"-10% 0 0 2%"});
	$('.goname').css({"top":"230px","right":"80px"});
	$('.scroll-pane').css({"height":"420px"});
	
}
function smallImg(){
	$('body').find('img').width("80%");	
	$('#bgPiank').css({"top":"23%"});
	$('#bgPiank img').css({"width":"90%"});
	$('#backstretch img').css({"width": "100%"});
	$('body').css({"font-size":"0.8em"});
	$('.scroll-pane, .voucherBox').css({"font-size":"1.3em", "line-height": "1.6em"});
	$('#scrollBox').css({"bottom":"2%"});
	$('.inBox1').css({"left":"10px","top":"220px"});
	$('.inBox1 p').css({"width":"80%"});
	$('.inTitle').css({"left":"20px","top":"40px"});
	$('.inTitleLogo').css({"left":"115px"});
	$('.inBox2').css({"right":"-60px","top":"190px"});
	$('.inBox2 p').css({"top":"245px","right":"140px"});
	$('.inSquirrel').css({"right":"215px"});
	$('.inActivity').css({"right":"130px"});
	$('.inPrize').css({"right":"20px"});
	$('.registerBtn').css({"right":"5px"});
	$('.conBox1').css({"top":"-135px","right":"-80px"});
	$('.prize1').css({"top":"240px","right":"30px"});
	$('.prize2').css({"top":"90px","left":"-80px"});	
	$('.conBox2').css({"top":"-55px"});
	$('.conBoxT').css({"right":"-120px"});
	$('.goNameBtn').css({"bottom":"240px","left":"180px"});
	$('.squirrelDialog').css({"left":"-215px"});
	$('.squirrelDialog p').css({"top":"30px","left":"25px"});
	$('.touchMe').css({"right":"-35px"});
	$('.activityBox').css({"top":"-225px"});
	$('#activity > div.activityTxt').css({"width":"954px","margin-left":"-477px"});
	$('.actFL div.actImg').css({"margin":"0 0 0 3%"});
	$('.goname').css({"top":"190px","right":"25px"});
	$('.scroll-pane').css({"height":"380px"});
	$(".bigimgrng img").width("100%");
	
}
function reImg(){
	if($(window).width()<=1200||$(window).height()<=800){
		smallImg();
		if($(window).height()<=700){
			$('#bgPiank').css({"top":"20%"});
		}
		if($(window).height()<=600){
			$('#bgPiank').css({"top":"12%"});
		}
	}else{
		bigImg();
	}
}
$(window).load(function(){
	$('.section').height($(window).height());
	reImg();
	//index intro
	setTimeout(function(){$('.inSquirrel').animate({margin:"-300px 0 0 0"}).animate({margin:"0",opacity:1});},100);
	setTimeout(function(){$('#bgPiank img').animate({margin:"30px 0 0 0"}).animate({margin:"0",opacity:1});},200);	
	setTimeout(function(){$('.inTitle > img').show('scale', {duration: 1000,easing: 'easeOutBounce'});},1500);
	setTimeout(function(){$('.inBox1,.inBox2,.inActivity,.inPrize,.registerBtn').animate({margin:"0 0 50px 0"}).animate({margin:"0",opacity:1});},800);
	setTimeout(function(){$('#scrollBox a').animate({opacity:1});},1800);
	setTimeout(function(){$('.inTitleLogo > img').show('scale', {duration: 1000,easing: 'easeOutBounce'});},1500);
	$('.scroll-pane').mCustomScrollbar({
		scrollEasing:"easeOutQuint",
		autoDraggerLength:false,
		set_width:"80%",
		scrollButtons:{
		enable:true,
		}
	});
});
$(document).ready(function() {
	$.backstretch("images/bg.jpg");
	$('.next, .top').click(function(){
		$(this).animate({opacity:0},1000,'easeOutQuad');
		$(this).find('img').animate({opacity:0},1000,'easeOutQuad');
	});
	$('.goname').click(function(){
		$('#bgPiank').animate({opacity:1},1000,'easeOutQuad');
	});
	$('#fullpage').fullpage({
		menu: '#scrollBox',
		anchors: ['firstPage', 'secondPage','3rdPage'],
		'afterLoad': function(anchorLink, index){
					if(index == 3){
						$('#bgPiank').animate({opacity:0},1000,'easeOutQuad');
						$('#priza').animate({opacity:0},1000,'easeOutQuad');
						$('#activity').animate({opacity:1},1000,'easeOutQuad');
						$('#scrollBox').css({opacity:0});
					}else if(index == 2){
						$('#bgPiank').animate({opacity:1},1000,'easeOutQuad');
						$('#priza').animate({opacity:1},1000,'easeOutQuad');
						$('#activity').animate({opacity:0},1000,'easeOutQuad');
						setTimeout(function(){$('#scrollBox a').animate({opacity:1});},100);
						$('.next, .next img').animate({opacity:0},1000,'easeOutQuad');
						$('.next a').css({"z-index":"1"});
						$('.top, .top img').animate({opacity:1},1000,'easeOutQuad');
						$('.top a').css({"z-index":"2"});
						$('#scrollBox').css({opacity:1});
					}else if(index == 1){
						$('.next, .next img').animate({opacity:1},1000,'easeOutQuad');
						$('.next a').css({"z-index":"2"});
						$('.top, .top img').animate({opacity:0},1000,'easeOutQuad');
						$('.top a').css({"z-index":"1"});
						$('#scrollBox').css({opacity:1});
					}
				}
	});	
	function animateDivers() {
		 $('#scrollBox a').animate({margin:"-20px 0 0 0"},500,'easeOutQuad').animate({margin:"0"},500,'easeOutQuad', animateDivers);
		 $('.inActivity img, .inPrize img').animate({margin:"-20px 0 0 0"},1000,'easeOutQuad').animate({margin:"0"},1000,'easeOutQuad', animateDivers);
		 $('.inSquirrel img, .inSquirrel2 img').animate({top:"-=15px"},2000,'easeInOutQuad').animate({top:"+=15px"},2000,'easeInOutQuad', animateDivers);
	};
	animateDivers();

	$(window).resize(function(){
		reImg();
	});

	$(".inActivity").hover(function(){			  
		$(this).find("img").animate({margin:"-10px 0 0 0"},500,'easeOutQuad');			
	},function(){			  
		$(this).find("img").animate({margin:"0"},500,'easeOutQuad');			
	});
	$(".registerBtn").hover(function(){			  
		$(this).animate({top:"+=10px",right:"-=10px"},100,'easeOutQuad');			
	},function(){			  
		$(this).animate({top:"-=10px",right:"+=10px"},100,'easeOutQuad');			
	});
	$(".goNameBtn").hover(function(){			  
		$('.touchMeOv').animate({opacity:1},100,'easeOutQuad');			
	},function(){			  
		$('.touchMeOv').animate({opacity:0},100,'easeOutQuad');			
	});

});

