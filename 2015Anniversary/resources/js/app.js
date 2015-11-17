function html5localStorage(){
  try{ localStorage.setItem('z','z'); localStorage.removeItem('z'); return true; }
  catch(e){ return false; }
}

// Fancyboxe init
// Fancybox global setting for defaults
// @see fancybox docs http://fancyapps.com/fancybox/#docs
//$.fancybox.defaults.parent = '#wrap';
$.fancybox.defaults.wrapCSS = 'modal-fancybox';
$.fancybox.defaults.helpers.title = null;
$.fancybox.defaults.helpers.overlay.locked = true;
$.fancybox.defaults.helpers.overlay.speedOut = 150;
$.fancybox.defaults.closeEffect = 'none';
$.fancybox.defaults.closeSpeed = 0;
$.fancybox.defaults.autoSize = true;
$.fancybox.defaults.closeClick = false; //	If set to true, fancyBox will be closed when user clicks the content
$.fancybox.defaults.padding = 0;
$.fancybox.defaults.margin = 0;

var App={
  conf:{
    cache_root:'bbt.'
   ,cacheable:html5localStorage()
  }
 
 ,init:function(){
    
    setInterval(App._keepalive,5*60*1000);
    
    
    $('#dlg-login').on('click','.btn-login-fb,.btn-login-gp',function(e){
      e.preventDefault();
      var w=500,h=500
         ,popLeft=Math.round((screen.availWidth-w)/2)
         ,popTop=Math.round((screen.availHeight-w)/2)
         ,features='width='+w+',height='+h+',resizable=yes,status=no,menubar=no,left='+popLeft+',top='+popTop+',dependent=yes'
         ,popWin = window.open($(this).prop('href'),'bubulogin',features);
      popWin.focus();
    });
    
    if( $('body').hasClass('req-login') && !App.auth.isLoggedIn() ){
      App.auth.showLoginDialog({noCancel:true});
    }
    
    // fav
    $('body').on('click','.bookmark, .follow',function(e){
      e.preventDefault();
      //App._log( "bookmark clicked" );
      App.fav.toggle(this);
    });
    
    if( $('#nav .user').length==1 ){
      $('#nav .user, #user-menu').hover( 
        App.showUserMenu
       ,function(){ $('#user-menu').data('left',App._now()); setTimeout(App.hideUserMenu,1000); }
      );
    }
    
  }// end App.init
 
 ,showUserMenu:function(){
    //App._log( 'showUserMenu() '+App._now() );
    var menu=$('#user-menu');
    menu.data('entered',App._now()).data('left',0);
    if( false==menu.hasClass('on') ){
      $('#user-menu').addClass('on').fadeTo(0,0).css('display','block').fadeTo(100,1);
    }
    setTimeout(App.hideUserMenu,2000);
  }
  
 ,hideUserMenu:function(){
    //App._log( 'hideUserMenu() '+App._now() );
    var menu=$('#user-menu'), entered=parseInt(menu.data('entered'),10), left=parseInt(menu.data('left'),10);
    if( false==menu.hasClass('on') || left==0 )return;
    if( (left-1)>entered || ( left>0 && App._now() > (left+1) ) ){
      menu.removeClass('on').fadeTo(100,0,function(){ menu.css('display','none'); });
      return;
    }
    setTimeout(App.hideUserMenu,1000);
  }
 
  // auth module
 ,auth:{
    
    isLoggedIn:function(){
      return ($('#nav-member-link .user').length==1);
    }// end App.auth.isLoggedIn
    
   ,showLoginDialog:function(opts){
      if(typeof opts=='undefined')opts={};
      var fcbSetting = {
    		type: 'inline',
    		closeBtn: (typeof(opts.noCancel)!='undefined' && true===opts.noCancel ? false : true),
    		width: 'auto',
    		height: 'auto'
    	}
      $.fancybox.open('#dlg-login', $.extend(fcbSetting, { helpers: { overlay: { closeClick: false } } }));
      
    }// end App.showLoginDialog
    
  }// end App.auth
  
  
  // fav module
 ,fav:{
   
    toggle:function(bkObj){
      var heart=$(bkObj)
    	   ,is_fav=$(bkObj).hasClass('on')
    	   ,fav=$(bkObj).data('fav')
    	   ,url='/api/'+(is_fav?'unfav':'fav')
    	   ,payload={};
      if( typeof(fav)=='undefined' )return;
      switch(fav.type){
        case 'blog':payload.b=[fav.id];break;
        case 'trip':payload.t=[fav.id];break;
        case 'spot':payload.s=[fav.id];break;
        case 'user':payload.u=[fav.id];break;
        default:return;
      }
    	$.post(url,payload,function(res){
      	if(res.success==1){
      	  var cnt=parseInt(heart.text(),10);
        	if(is_fav){
        	  if(fav.type=='user') heart.removeClass('on')
        	  else heart.removeClass('on').html((cnt-1)+' <i></i>');
          }
        	else{
        	  if(fav.type=='user') heart.addClass('on');
        	  else heart.addClass('on').html((cnt+1)+' <i></i>');
        	  App.fav.doFlyingHeart( parseInt($('i',heart).offset().left,10), parseInt($('i',heart).offset().top,10) );
        	}
      	}else{
        	alert(res.msg);
      	}
    	},'json');
    }
  
   ,doFlyingHeart:function(fromLeft,fromTop){
      var favNav = $('#nav .n4'), toLeft=favNav.offset().left+49, toTop=37;
      $('body').append('<i class="bookmark-flyer"></i>');
      dur=1000;
      if(fromTop>600)dur=1250;
      else if(fromTop>2000)dur=1500;
      $('.bookmark-flyer')
        .css({left:fromLeft+'px',top:fromTop+'px'})
        .animate({left:toLeft+'px',top:toTop+'px'},dur,function(){
          $(this).fadeTo(200,0,function(){ $(this).remove(); });
        });
    }

   
  }
 
  // date and time
 ,_now:function(){
    return Math.round((new Date()).getTime()/1000);
  }

 ,_time:function(){
    return (new Date()).getTime();   
 }
 
 ,_ts2date:function(ts){
    var date=new Date(ts*1000),Y=date.getFullYear(),m=APP._pad0(date.getMonth()+1,2),d=APP._pad0(date.getDate(),2);
    return ""+Y+"-"+m+"-"+d;
  }
 
 ,_ts2time:function(ts){
    var date=new Date(ts*1000),H=APP._pad0(date.getHours(),2),i=APP._pad0(date.getMinutes(),2),s=APP._pad0(date.getSeconds(),2);
    return ""+H+":"+i+":"+s;
  }
 
 ,_ts2human:function(ts,format){
    var date=new Date(ts*1000),H=APP._pad0(date.getHours(),2),i=APP._pad0(date.getMinutes(),2);
    switch(format){
      default: // APR 15, 14:40
        return ''+APP.conf.months[date.getMonth()]+' '+date.getDate()+', '+H+':'+i;
    }
  }
 
 ,_mins2human:function(mins,format){
    switch(format){
      case 'hhmm': case '0000':
        return ""+App._pad0(Math.floor(mins/60),2)+App._pad0(Math.round(mins%60),2);
      break;
      case 'H:i': case '00:00':
        return App._pad0(Math.floor(mins/60),2)+":"+App._pad0(Math.round(mins%60),2);
      break;
      case 'travel':
        if(mins<60){return mins+'分鐘';}
        return Math.floor(mins/60)+'小時'+(mins%60>0 ? (mins%60)+"分鐘":"");
      break;
    }
  }
  
 ,_human2mins:function(str,format){
    switch(format){
      case 'hhmm': case '0000':
        return parseInt(str.substr(0,2),10)*60+parseInt(str.substr(2,2),10);
      break;
      case 'H:i': case '00:00':
        return parseInt(str.substr(0,2),10)*60+parseInt(str.substr(3,2),10);
      break;
    }
  }
  
  // string manipulation
 ,_pad0:function(num,len){
    var str=''+num;
    while(str.length<len){
      str = '0'+str;
    }
    return str;
  }
 ,_nl2br:function(s){
    return s.replace(/\n/g,"<br>");
  }
  /*
 ,_escapeHtml:function(unsafe){
    return unsafe.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
  }
  */
 ,_escapeHtml:function(str) {
    var div = document.createElement('div');
    div.appendChild(document.createTextNode(str));
    return div.innerHTML;
  }
 
 
  // numbers
 ,_rand:function(s,e){
    var v=e-s; return s+Math.round( Math.random()*v );
  }
 ,_chance:function(c){
    return (Math.random()<c);
  }
  
 
  // miscellaneous
 ,_isArray:function(a){
    return Object.prototype.toString.apply(a)==='[object Array]';
  }
 
 ,_log:function(s){//attempts console.log if applicable
    if(typeof console!='undefined'&&console.log)try{console.log(s)}catch(e){}
  }
  
 ,_keepalive:function(){
    $.post('/api/keepalive/',{t:App._now()},function(res){}); 
  }
  
 ,_track:function(cat,act,label){
    try
    {
      if(typeof label!="string")label=null;
      ga('send','event',cat,act,label);
    }
    catch(e)
    { App._log('_track("'+cat+'","'+act+'") failed'); } 
  }
  
 ,getDistance:function(lat1,lon1,lat2,lon2){//distance in km
  	var deg2rad = 0.017453292519943295; // === Math.PI / 180
    var cos = Math.cos;
    lat1 *= deg2rad;
    lon1 *= deg2rad;
    lat2 *= deg2rad;
    lon2 *= deg2rad;
    var diam = 12742; // Diameter of the earth in km (2 * 6371)
    var dLat = lat2 - lat1;
    var dLon = lon2 - lon1;
    var a = (
       (1 - cos(dLat)) + 
       (1 - cos(dLon)) * cos(lat1) * cos(lat2)
    ) / 2;
    return diam * Math.asin(Math.sqrt(a));
  }
  
    
};


// App.cache component
App.cache={
  get:function(key){
    var cr=App.conf.cache_root;
    return (localStorage.getItem(cr+key)!=null) ? JSON.parse(localStorage.getItem(cr+key)):null;
  }
 ,set:function(key,val){
    localStorage.setItem(App.conf.cache_root+key,JSON.stringify(val));
  }
 ,del:function(key){
    localStorage.removeItem(App.conf.cache_root+key);
  }
}


$(function(){ App.init(); });