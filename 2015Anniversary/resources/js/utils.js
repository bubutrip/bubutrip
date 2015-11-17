/** Utiliities
 * @version 20141014
 */




/* imgCovered
 */
$.fn.coverimg = function(){
	return this.each( function(){
		var img = $('img',this),
			mask = img.wrap('<div class="mask"></div>').parent(),
			url = img[0].src;
		
		
		mask.css({
		   backgroundImage: 'url(' + url + ')',
		   backgroundSize: 'cover',
		   webkitBackgroundSize: 'cover',
		   mozBackgroundSize: 'cover',
		   msBackgroundSize: 'cover',
		   backgroundPosition: 'center center',
		   backgroundRepeat: 'no-repeat'
		});
		
		img.css( 'visibility', 'hidden' );
	});
}
$(function(){
   //$( '[data-coverimg]' ).coverimg();	
});



/* scrollto()
 */

$(function(){
	$('a.backtop').on('click', function(e){
		scrollto(0);
		e.preventDefault();
	});
});

function scrollto( y, d, e ) {
	$( 'html, body' ).animate({ scrollTop:y }, { duration: d>=0?d:300 });	
};





/* Expand body frame height
 * according to page content (#wrap)
 */
$(function() {
	!!$('body[class*="framed"]')[0] && $(window).on('resize load', ajustBodyFrame);
});


function ajustBodyFrame() {
	var sH = $(window).height(),
		wH = $('#wrap').height(),
		borderW = 5*2;
	
	if( sH > wH + borderW) {
		$('body').css('min-height', sH - borderW)
	} else {
		$('body').css('min-height', '')
	}
}