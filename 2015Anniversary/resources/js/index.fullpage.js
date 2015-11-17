$(document).ready(function() {	
	$('#fullpage').fullpage({
		autoScrolling: false,
		anchors: ['firstPage', 'secondPage'],
		'afterLoad': function(anchorLink, index){
					if(index == 2){
						$('.index > div, .inGetCodeBtn a, .inActivityBtn a,.inGetCodeBtnOv, .inActivityBtnOv').css({opacity:0});
						$('.prizeContent > div').css({opacity:0});
						setTimeout(function(){$('.prTree1, .prTree2').animate({opacity:1},'easeOutQuad');},100);
						setTimeout(function(){$('.prPic1').animate({margin:"-50px 0 0 0"}).animate({margin:"0",opacity:1},'easeOutQuad');},500);
						setTimeout(function(){$('.prPic1Txt').animate({margin:"50px 0 0 0"}).animate({margin:"0",opacity:1},'easeOutCubic');},500);
						setTimeout(function(){$('.prPic2').animate({margin:"0 -50px 0 0"}).animate({margin:"0",opacity:1},'easeOutQuad');},1000);
						setTimeout(function(){$('.prPic2Txt').animate({margin:"0 0 0 -50px"}).animate({margin:"0",opacity:1},'easeOutCubic');},1000);
						setTimeout(function(){$('.prPic3').animate({margin:"0 0 0 -50px"}).animate({margin:"0",opacity:1},'easeOutQuad');},1500);
						setTimeout(function(){$('.prPic3Txt').animate({margin:"0 -50px 0 0"}).animate({margin:"0",opacity:1},'easeOutCubic');},1500);
						$('.scrollUpBtn a').click(function(){
							$('.index > div, .inGetCodeBtn a, .inActivityBtn a,.inGetCodeBtnOv, .inActivityBtnOv').css({opacity:0});
							$('.prizeContent > div').css({opacity:0});
						});
					}else if(index == 1){
						$('.index > div, .inGetCodeBtn a, .inActivityBtn a,.inGetCodeBtnOv, .inActivityBtnOv').css({opacity:0});
						$('.prizeContent > div').css({opacity:0});
						setTimeout(function(){$('.inSquirrel').animate({margin:"-300px 0 0 0"}).animate({margin:"0",opacity:1},'easeOutCubic');},100);
						setTimeout(function(){$('.inGetCodeBtn a').animate({margin:"-300px 0 0 0"}).animate({margin:"0",opacity:1}),'easeOutCubic';},500);
						setTimeout(function(){$('.inTitle').animate({opacity:1},'easeOutQuad');},1000);
						setTimeout(function(){$('.inCake').animate({margin:"0 -80px 0"}).animate({margin:"0",opacity:1},'easeOutCubic');},1500);
						setTimeout(function(){$('.inActivityBtn a').animate({margin:"0 0 0 80px"}).animate({margin:"0",opacity:1},'easeOutCubic');},1500);
						setTimeout(function(){$('.inForest').animate({margin:"20px 0 0 0"}).animate({margin:"0",opacity:1},'easeOutCubic');},1500);
						setTimeout(function(){$('.inTxt').animate({margin:"-100px 0 0 0"}).animate({margin:"0",opacity:1},'easeOutQuad');},2000);
						//setTimeout(function(){$('.inScore, .scrollDownBtn').animate({opacity:1},'easeOutQuad');},3500);
						setInterval(function(){$(".scrollDownBtn").animate({bottom:"+=20px"},500,'easeOutQuad').animate({bottom:"-=20px",opacity:1},500,'easeOutQuad')},1);
						setInterval(function(){$(".inGetCodeBtn").animate({top:"-=30px",opacity:1},2000,'easeOutQuad').animate({top:"+=30px",opacity:1},1500,'easeOutQuad')},500);
						setInterval(function(){$(".inActivityBtn").animate({top:"+=20px",opacity:1},2000,'easeOutQuad').animate({top:"-=20px",opacity:1},1500,'easeOutQuad')},1500);
						$('.scrollDownBtn a').click(function(){
							$('.index > div, .inGetCodeBtn a, .inActivityBtn a,.inGetCodeBtnOv, .inActivityBtnOv').css({opacity:0});
							$('.prizeContent > div').css({opacity:0});
						});
					}
				}
	});	
});