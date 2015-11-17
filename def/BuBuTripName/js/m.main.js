
$(document).ready(function() {
	$.backstretch("images/bg.jpg");
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
		 $('.tail img').animate({opacity:0},1000,'easeInOutQuad').animate({opacity:1},1000,'easeInOutQuad', animateDivers);
	};
	animateDivers();
});