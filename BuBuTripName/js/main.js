function bigImg(){
	$('body').find('img').width("100%");
	$('body').css({"font-size":"1em"});
	$('.inBox1').css({"left":"50px","bottom":"10%"});
	$('.inBox2').css({"right":"50px","bottom":"10%"});
	$('.inBox1 > div').css({"right": "18%"});
	$('.inSquirrel').css({"left":"260px","top":"8%"});		
	$('p.inBox2ST').css({"margin": "-0.8em 0 0 26%"});
	$('.scrollBtn').css({"left":"45%"});
	$('.inActivity').css({"top":"215px","right":"30px"});
	$('.inPrize').css({"top":"440px","left":"500px"});
	$('.conBox1,.conSquirrel1').css({"bottom":"-310px"});
	$('.conSquirrel1').css({"right":"-30px"});
	$('.conBox1 h2').css({"top":"-70px","left":"120px"});
	$('.conBox1 form').css({"top":"55px","left":"140px"});
	$('.conBox1 form textarea').css({"margin-top":"15px"});
	$('.conBox1 ol').css({"bottom":"40px","left":"90px"});
	$('.sendBtn').css({"top":"300px","right":"50px"});
	$('.conBox2').css({"bottom":"250px"});
	$('.conBox2 > div').css({"top":"40px","left":"160px"});
	$('.reviewBtn').css({"top":"195px","left":"220px"});
	$('.downloadBtn').css({"top":"200px","left":"320px"});
	$('.fbBtn').css({"top":"185px","left":"420px"});
	$('.nameBg').css({"bottom":"160px","right":"320px"});
	$('.touchMe').css({"top":"135px","right":"-85px"});
	$('.tail').css({"bottom":"30px","right":"0"});
	$('.activityBox').css({"top":"-280px"});
	$('#activity > div.activityTxt').css({"width":"1192px","margin-left":"-596px"});
	$('.actFL div.actImg').css({"margin":"-10% 0 0 2%"});
	$('.goname').css({"top":"230px","right":"80px"});
	$('.scroll-pane').css({"height":"420px"});
}
function smallImg(){
	$('body').find('img').width("80%");
	$('#backstretch img').css({"width": "100%"});
	$('body').css({"font-size":"0.8em"});
	$('.scroll-pane').css({"font-size":"1.2em"});
	$('.inBox1').css({"left":"-125px","bottom":"20%"});
	$('.inBox2').css({"right":"-70px","bottom":"20%"});
	$('.inBox1 > div').css({"right": "10%"});
	$('.inSquirrel').css({"left":"60px","top":"10%"});
	$('p.inBox2ST').css({"margin": "-0.8em 0 0 20%"});
	$('.scrollBtn').css({"left":"40%"});
	$('.inActivity').css({"top":"185px","right":"10px"});
	$('.inPrize').css({"top":"400px","left":"320px"});
	$('.conBox1,.conSquirrel1').css({"bottom":"-240px"});
	$('.conSquirrel1').css({"right":"-130px"});
	$('.conBox1 h2').css({"top":"-50px","left":"100px"});
	$('.conBox1 form').css({"top":"40px","left":"115px"});
	$('.conBox1 form textarea').css({"margin-top":"0"});
	$('.conBox1 ol').css({"bottom":"35px","left":"65px"});
	$('.sendBtn').css({"top":"240px","right":"120px"});
	$('.conBox2').css({"bottom":"190px"});
	$('.conBox2 > div').css({"top":"20px","left":"130px"});
	$('.reviewBtn').css({"top":"155px","left":"180px"});
	$('.downloadBtn').css({"top":"160px","left":"270px"});
	$('.fbBtn').css({"top":"135px","left":"345px"});
	$('.nameBg').css({"bottom":"140px","right":"230px"});	
	$('.touchMe').css({"top":"110px","right":"0"});
	$('.tail').css({"bottom":"24px","right":"69px"});
	$('.activityBox').css({"top":"-225px"});
	$('#activity > div.activityTxt').css({"width":"954px","margin-left":"-477px"});
	$('.actFL div.actImg').css({"margin":"0 0 0 3%"});
	$('.goname').css({"top":"190px","right":"25px"});
	$('.scroll-pane').css({"height":"380px"});
}
function reImg(){
	if($(window).width()<=1200||$(window).height()<=720){
		smallImg();
	}else{
		bigImg();
	}
}
$(window).load(function(){
	$('.section').height($(window).height());	
	reImg();
	//index intro
	setTimeout(function(){$('.inSquirrel').animate({margin:"-300px 0 0 500px"}).animate({margin:"0",opacity:1});},100);
	setTimeout(function(){$('.inTitle img').show('scale', {duration: 1000,easing: 'easeOutBounce'});},1000);
	setTimeout(function(){$('.inBox1, .inBox2, .inActivity, .inPrize').animate({margin:"0 0 50px 0"}).animate({margin:"0",opacity:1});},1200);
	setTimeout(function(){$('.scrollBtn a').animate({opacity:1});},1600);
	$('.scroll-pane').mCustomScrollbar({
		scrollEasing:"easeOutQuint",
		autoDraggerLength:false,
		set_width:"80%",
		scrollButtons:{
		enable:true
		}
	});
});
$(document).ready(function() {
	$.backstretch("images/bg.jpg");
	$('#fullpage').fullpage({
		menu: '#scrollBox',
		autoScrolling: false,
		anchors: ['firstPage', 'secondPage', '3rdPage']
	});
	$(":text, textarea").each(function(i, ele){
		var tra,val
		var _text = $(ele),
			_title = _text.attr("title"),
			_class = _text.attr("class") || "";
		if(!!_title){
	  	val=$("."+_class).attr("title");
	  	$("."+_class).css("color","#717071");
	  	if($("."+_class).val()==""){
	  	  $("."+_class).val($("."+_class).attr("title"));
	  	}else{
	  		$("."+_class).removeAttr("style");
	  	}
	  }		
	  $("."+_class).focus(function(){
	    if(_title != $("."+_class).val()){
	      tra=$("."+_class).val();
	      $("."+_class).val(tra);
	    }else{
	      $("."+_class).val("");
	    }
	    $("."+_class).removeAttr("style");
		  var e = event.srcElement;
		  var r =e.createTextRange();
		  r.moveStart("character",e.title.length);
		  r.collapse(true);
		  r.select();
	  }).blur(function(){
	    if($("."+_class).val()==""){
	      $("."+_class).val(val);
	      $("."+_class).css("color","#717071");
	    }
	  });
	});
	
	function animateDivers() {
		 $('.scrollBtn img').animate({margin:"-20px 0 0 0"},500,'easeOutQuad').animate({margin:"0"},500,'easeOutQuad', animateDivers);
		 $('.inActivity img, .inPrize img').animate({margin:"-20px 0 0 0"},1000,'easeOutQuad').animate({margin:"0"},1000,'easeOutQuad', animateDivers);
		 $('.inSquirrel img').animate({margin:"-15px 0 0 0"},2000,'easeInOutQuad').animate({margin:"0"},2000,'easeInOutQuad', animateDivers);
		 $('.tail img').animate({opacity:0},1000,'easeInOutQuad').animate({opacity:1},1000,'easeInOutQuad', animateDivers);

	};
	animateDivers();

	$(window).resize(function(){
		reImg();
	});

	$(".btn").hover(function(){			  
		$(this).find("img").animate({margin:"-10px 0 0 0"},500,'easeOutQuad');			
	},function(){			  
		$(this).find("img").animate({margin:"0"},500,'easeOutQuad');			
	});
	$(".goticketBtn").hover(function(){			  
		$('.touchMeOv').animate({opacity:1},100,'easeOutQuad');			
	},function(){			  
		$('.touchMeOv').animate({opacity:0},100,'easeOutQuad');			
	});
});

