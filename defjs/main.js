$(document).ready(function() {

	var is_new_user = $("#is_new_user").val();
	console.log( is_new_user );

	var is_mobile=false;
	// for ticket index
	$('.fb').click(function(){
		var memberloginkey = $('#memberloginkey').val();
		var ticket_str = $('#ticket_str').val();

		if( memberloginkey == 1 ){

			if( ticket_str != '' ){
				$('.voucherBox').css('display','block');
			}else{
				location.href='/event/BuBuTripTicket/?ticket=1';
			}
		}else{
			if(is_mobile){
				location.href="/login/facebook";
				return;
			}
			var w=500,h=500
			   ,popLeft=Math.round((screen.availWidth-w)/2)
			   ,popTop=Math.round((screen.availHeight-w)/2)
			   ,features='width='+w+',height='+h+',resizable=yes,status=no,menubar=no,left='+popLeft+',top='+popTop+',dependent=yes'
			   ,popWin = window.open("/login/facebook",'bubulogin',features);
			popWin.focus();  
		}
	});

	// for tripname index
	$('.sendBtn').click(function(){

		alert("命名活動已結束，BuBuTrip小飛鼠新名字是「布卡」！");
		return false;

		/*
		var memberloginkey = $('#memberloginkey').val();
		if( memberloginkey != "" ){
		*/
			var mascotName = $("#mascotName").val();
			if( mascotName == '' ){
				alert("吉祥物命名名稱未輸入");
				$("#mascotName").focus();
				return false;
			}

			var mean = $("#mean").val();
			if( mean == '' ){
				alert("吉祥物命名意涵未輸入");
				$("#mean").focus();
				return false;
			}

			$("#setnameform").submit();

		/*
		}else{

			if(is_mobile){
				location.href="/login/facebook";
				return;
			}
			var w=500,h=500
			   ,popLeft=Math.round((screen.availWidth-w)/2)
			   ,popTop=Math.round((screen.availHeight-w)/2)
			   ,features='width='+w+',height='+h+',resizable=yes,status=no,menubar=no,left='+popLeft+',top='+popTop+',dependent=yes'
			   ,popWin = window.open("/login/facebook",'bubulogin',features);
			popWin.focus();  

		}
		*/

	})


	$('.voucherBox .voucherClose').click(function(){
		$('.voucherBox').css("display","none");
	})


	$('.closebtn').click(function(){
		$('#mask').css('display','none');
	})

	$('.showfbsharer').click(function(){
		if( is_new_user != '' ){
			$('#gofbsharer').trigger('click');
		}
	})


	$('.ticketfbsharer').click(function(){
		if( is_new_user != '' ){
			window.open('https://www.facebook.com/sharer/sharer.php?u=http://www.bubutrip.com.tw/event/BuBuTripTicket/', 'FaceBook分享', 'menubar=no,toolbar=no,height=600,width=600');
		}
	})

	$('.downloadbtn').click(function(){
		downLoadImage( $(this).data('url') );
	})


	$('#popupview .closebtn').click(function(){
		$('#popupview').css('display','none');
	})
	
});

function showfblike(){
	if( is_new_user != '' ){
		$('#mask').css('display','block');	
	}
}

/*
function downLoadImage(imagePathURL){
	if(!document.getElementById("_SAVEASIMAGE_TEMP_FRAME"))
		jQuery('<iframe style="display:none;" id="_SAVEASIMAGE_TEMP_FRAME"
		name="_SAVEASIMAGE_TEMP_FRAME" onload="_doSaveAsImage();"
		width="0" height="0" src="about:blank"></iframe>').appendTo("body");
		if(document.all._SAVEASIMAGE_TEMP_FRAME.src!=imagePathURL){
		document.all._SAVEASIMAGE_TEMP_FRAME.src = imagePathURL;
	}else{
		_doSaveAsImage();
	}
}

function _doSaveAsImage(){
	if(document.all._SAVEASIMAGE_TEMP_FRAME.src!="about:blank")
	document.frames("_SAVEASIMAGE_TEMP_FRAME").document.execCommand("SaveAs");
}
*/