$(document).ready(function(){

    $('.popup-wrap').mouseup(function (e){ 
        var block = $(".popup"); 
        if (!block.is(e.target) && block.has(e.target).length === 0) { 
        	$('.popup-wrap--active').removeClass('popup-wrap--active');
        }
    });

	$('.direction-item__info').on('click', function(){
		if ( !$(this).parent().hasClass('direction-item--active') ) {
			$('.direction-item--active').removeClass('direction-item--active');
		}
		$(this).parent().toggleClass('direction-item--active');
	});
});