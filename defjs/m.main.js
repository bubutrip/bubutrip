$(document).ready(function() {

	var is_new_user = $("#is_new_user").val();
	console.log( is_new_user );

	// for m.ticket index
	var is_mobile=true;
	$('.fb').click(function(){

		var memberloginkey = $('#memberloginkey').val();
		var ticket_str = $('#ticket_str').val();

		if( memberloginkey == 1 ){

			if( ticket_str != '' ){
				location.href='/event/BuBuTripTicket/m.register.php';
			}else{
				location.href='/event/BuBuTripTicket/m.register.php?ticket=1';
				//alert("您已獲得抽獎資格，8月19日將於本活動網站公佈得獎主，請密切注意註冊信箱。");
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

	$('.closebtn').click(function(){
		$('#mask').css('display','none');
	})


	// for m.tripname index
	$('.sendBtn').click(function(){

		alert("命名活動已結束，BuBuTrip小飛鼠新名字是「布卡」！");
		return false;

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
	})

	$('.ticketfbsharer').click(function(){
		if( is_new_user != '' ){
			window.open('https://www.facebook.com/sharer/sharer.php?u=http://www.bubutrip.com.tw/event/BuBuTripTicket/', 'FaceBook分享');
		}
	})

	$('.showfbsharer').click(function(){
		if( is_new_user != '' ){
			console.log("go sharer window...");
			window.open('https://www.facebook.com/sharer/sharer.php?u=http://www.bubutrip.com.tw/event/BuBuTripName/', 'FaceBook分享');
		}
	})

	$('.showfbsharer1').click(function(){
		window.open('https://www.facebook.com/sharer/sharer.php?u=http://www.bubutrip.com.tw/event/BuBuTripName/', 'FaceBook分享');
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
