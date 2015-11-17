function bigImg(){
	$('#contents').css({"top":"50%", "margin":"-400px 0 0 -495px","height":"800px"});
	$('h2').css({"margin":"0 auto 45px"});
	$('.register .other').css({"padding-bottom":"15px","margin-bottom":"17px"});
	$('.register form.jqtransformdone .other div.rowElem').css({"height":"30px","padding-top":"14px"});
	$('.register form.jqtransformdone .other div.rowElem').css({"padding-top":"14px"});
	$('.registerSquirrel').css({"bottom":"100px"});
	$('.register form.jqtransformdone div.submitBtn').css({"margin":"0 auto"});
	$('.loginSquirrel').css({"bottom":"140px"});
	$('.login .account, .login .connect').css({"padding":"50px 0","margin-top":"0"});
	$('.inviteTxt').css({"bottom":"100px"});
	$('.inTitle').css({"top":"180px"});
	$('.inForest').css({"top":"58px"});
	$('.inCake').css({"top":"214px"});
	$('.inTxt').css({"top":"392px"});
	$('.inSquirrel').css({"top":"360px"});
	$('.inGetCodeBtn').css({"top":"64px"});
	$('.inActivityBtn').css({"top":"205px"});
	$('.inScore').css({"bottom":"40px","right":"45px"});
	$('.scrollDownBtn').css({"margin-left":"-61px"});
	$('.prizeHeader').css({"padding":"30px 0"});
	$('.prizeContent').css({"top":"280px", "height":"500px"});
	$('.prTree1 img').css({"height":"548px"});
	$('.prTree2 img').css({"width":"702px"});
	$('.prPic1 img').css({"width":"354px"});
	$('.prPic2 img').css({"width":"310px"});
	$('.prPic3 img').css({"width":"310px"});
	$('.prTree1').css({"top":"0","left":"300px"});
	$('.prTree2').css({"top":"340px","left":"300px"});
	$('.prPic1').css({"top":"0","left":"-85px"});
	$('.prPic1Txt').css({"top":"380px","left":"-85px"});
	$('.prPic2').css({"top":"0","right":"0"});
	$('.prPic2Txt').css({"top":"50px","left":"380px"});
	$('.prPic3').css({"top":"300px","left":"340px"});
	$('.prPic3Txt').css({"top":"370px","right":"-20px"});
	$('.finalContentsBox img').css({"height":"494px","margin":"0 auto 30px"});
}
function smallImg(){
	$('#contents').css({"margin":"-310px 0 0 -495px","height":"620px"});
	$('h2').css({"margin":"0 auto 15px"});
	$('.register .other').css({"padding-bottom":"5px","margin-bottom":"5px"});
	$('.register form.jqtransformdone .other div.rowElem').css({"height":"25px","padding-top":"10px"});
	$('.register form.jqtransformdone .other div.rowElem').css({"padding-top":"7px"});
	$('.registerSquirrel').css({"bottom":"0"});
	$('.register form.jqtransformdone div.submitBtn').css({"margin":"-10px auto 0"});
	$('.loginSquirrel').css({"bottom":"10px"});
	$('.login .account, .login .connect').css({"padding":"20px 0","margin-top":"20px"});
	$('.inviteTxt').css({"bottom":"-20px"});
	$('.inTitle').css({"top":"122px"});
	$('.inForest').css({"top":"0"});
	$('.inCake').css({"top":"156px"});
	$('.inTxt').css({"top":"334px"});
	$('.inSquirrel').css({"top":"302px"});
	$('.inGetCodeBtn').css({"top":"6px"});
	$('.inActivityBtn').css({"top":"147px"});
	$('.inScore').css({"bottom":"20px","right":"25px"});
	$('.scrollDownBtn').css({"margin-left":"-40px"});
	$('.prizeHeader').css({"padding":"15px 0"});
	$('.prizeContent').css({"top":"190px", "height":"450px"});
	$('.prTree1 img').css({"height":"460px"});
	$('.prTree2 img').css({"width":"650px"});	
	$('.prPic1 img').css({"width":"280px"});
	$('.prPic2 img').css({"width":"240px"});
	$('.prPic3 img').css({"width":"240px"});
	$('.prTree1').css({"top":"0","left":"350px"});
	$('.prTree2').css({"top":"260px","left":"350px"});
	$('.prPic1').css({"top":"0","left":"0"});
	$('.prPic1Txt').css({"top":"300px","left":"0"});
	$('.prPic2').css({"top":"0","right":"30px"});
	$('.prPic2Txt').css({"top":"10px","left":"400px"});
	$('.prPic3').css({"top":"220px","left":"400px"});
	$('.prPic3Txt').css({"top":"280px","right":"-10px"});
	$('.finalContentsBox img').css({"height":"380px","margin":"110px auto 20px"});
}
function reImg(){
	if($(window).width()<=1200||$(window).height()<=800){
		smallImg();
	}else{		
		bigImg();		
	}
}

$(window).load(function(){
	$('.section').height($(window).height());	
	reImg();
});
$(document).ready(function() {	
	reImg();
	$(window).resize(function(){
		reImg();
	});
	if(navigator.userAgent.indexOf("MSIE") != -1) {
        $('img').each(function() {
            if($(this).attr('src').indexOf('.png') != -1) {
                $(this).css({
                    'filter': 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' +
                    $(this).attr('src') +
                    '", sizingMethod="scale");'
                });
            }
        });
    }

	$(".inGetCodeBtn a").hover(function(){			  
		$('.inGetCodeBtnOv').animate({opacity:1},500,'easeOutQuad');
	},function(){			  
		$('.inGetCodeBtnOv').animate({opacity:0},200,'easeOutQuad');			
	});
	$(".inActivityBtn a").hover(function(){			  
		$('.inActivityBtnOv').animate({opacity:1},500,'easeOutQuad');
	},function(){			  
		$('.inActivityBtnOv').animate({opacity:0},200,'easeOutQuad');			
	});
});

