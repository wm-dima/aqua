$(document).ready(function(){

    $('.popup-wrap').mouseup(function (e){ 
        var block = $(".popup"); 
        if (!block.is(e.target) && block.has(e.target).length === 0) { 
        	$('.popup-wrap--active').removeClass('popup-wrap--active');
        	$('main').removeClass('main--active');
        }
    });

    $('.popup-wrap').mouseup(function (e){ 

        var block1 = $(".direction-item__info"); 
        if (!block1.is(e.target) && block1.has(e.target).length === 0) { 

            var block2 = $(".direction-item__popup"); 
            if (!block2.is(e.target) && block2.has(e.target).length === 0) { 
                $('.direction-item--active').removeClass('direction-item--active');
            }
        }

    });

	$('.direction-item__info').on('click', function(){
		if ( !$(this).parent().hasClass('direction-item--active') ) {
			$('.direction-item--active').removeClass('direction-item--active');
		}
		$(this).parent().toggleClass('direction-item--active');
	});
});