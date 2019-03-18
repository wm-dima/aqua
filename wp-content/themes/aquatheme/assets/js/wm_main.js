'use strict'

let order = {
	firstStep: {
		'аквастар':{
			count: null,
			firstTimeComplect: false
		},
		'благодатна':{
			count: null,
			firstTimeComplect: false
		},
		'магазин':{
			count: null,
			firstTimeComplect: false
		}
	},
	secondStep: {
		mail: null,
		phone: null,
		fio: null,
		adress: null,
		time: '09:00-10:00',
		day: null,
		month: null,
		payCart: false
	}
};



let mimWidth = 1200;
let selectedProd = null;
let priceNode = document.querySelector('.card-wrap__total span');
let selectTimeHid = true;
let formStep2Valid = false;
let calcCount = document.querySelector('[data-calc-attr="count"]');
let totalOrder = [];
let monthNames = ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"];
let miniClickNumber = 0;
let miniLastStep = false;
let firstClick = true;

document.querySelector('#start-order').addEventListener('click', function(e){
	miniClickNumber = 0;
	resetOrder();
	if (isMinWidth) {
		miniClickNumber = 0;
		showPopUp(0);
	} else {
		showPopUp(0);
	}
	mySwiper.update();
});

document.querySelector('.popup.popup1').addEventListener('click', function(e){
	if ( e.target.classList.contains('direction-item__button') ) {
		document.querySelector('.wm-select-time').classList.add('wm-hid');
		selectTimeHid = true;
		selectWaterType(e);
	}
});

document.querySelector('.popup.popup2').addEventListener('click', function(e){
	e.preventDefault();		

	if (e.target.closest('.form-item__packet') != null) {
		toggleFirstTimeComplect(e.target.closest('.form-item__packet'));
	}
	if (e.target.hasAttribute('data-calc-attr')) {
		calculatorController(e);
	}
	if (e.target.closest('[data-calendar-count]')) {
		controllerCalendarCurrent(e);
	}
	if (e.target.closest('[data-calendar-count-next]')) {
		controllerCalendarNext(e);
	}
	if (e.target.closest('.when-select-wrap')) {
		document.querySelector('.wm-select-time').classList.toggle('wm-hid');
		selectTimeHid = !selectTimeHid;
		if (e.target.closest('.when-select__item')) {
			updateTime(e);
		}
	} else if ( !selectTimeHid && e.target.closest('.wm-select-time') == null ) {
		document.querySelector('.wm-select-time').classList.add('wm-hid');
		selectTimeHid = true;
	}
	if (e.target.getAttribute('data-wm-go') == 'step-3') {
		if ( isMinWidth() ) {
			min.step2Controller(e);
		} else {
			big.step2Controller(e);
		}
	}
	if (e.target.closest('[data-wm-step-back]')) {
		// resetOrder();
		min.stepBackController(e);
	}	
});

function updateTime(e){
	var date = new Date();
	if ( 
		(date.getHours > 17 || date.getHours < 8) && 
		(e.target.innerText == '6:00-8:00' || e.target.innerText == '8:00-11:00')
	) return;
	order.secondStep.time = e.target.innerText;
	document.querySelector('.when-select__item').innerText = e.target.innerText;
	try {
		document.querySelector('.selected-time-error').classList.remove('selected-time-error');
	} catch(er) {}
}

function resetOrder(){
	Object.keys(order.firstStep).forEach(function(itm){
	    order.firstStep[itm].count = null;
	})
}

function isMinWidth(){
	return window.innerWidth < mimWidth;
}

class Big {
	step2Controller(e){
		document.querySelector('[data-wm-order="save"]').click();
		if ( order.secondStep.time == null ) {
			document.querySelector('.when-select__item.when-select__item--active').classList.add('selected-time-error');
		}
		if (isValidStep2()) {
			preparePopUp2();
			showPopUp(2);
		};
	}
}

function showPopUp(number) {
	if ( number == 0 ) resetOrder();
	if ( selectedProd == 'магазин' ) {
		document.querySelector('.form-item__wrap .form-item__packet').classList.add('wm-hid');
	} else {
		document.querySelector('.form-item__wrap .form-item__packet').classList.remove('wm-hid');
	}
	document.querySelector('main').classList.add('main--active');
	try{
		document.querySelector('.popup-wrap--active').classList.remove('popup-wrap--active');
	} catch (e){}
	document.querySelectorAll('.popup-wrap')[number].classList.add('popup-wrap--active');
}

class Min {
	showPopUp2(e){
		this.step2Controller(e);
	}
	step2Controller(e){
		if (miniClickNumber == 0){ //показал воду
			this.showStep2part(0);
			miniClickNumber = 1;
			miniLastStep = false;
			return;
		}
		if ( miniClickNumber == 1 && order.secondStep.day != null && order.secondStep.time != null ) { // показал дату
			this.showStep2part(1);
			miniClickNumber = 2;
			miniLastStep = false;
			firstClick = true;
			return;
		}
		if (miniClickNumber == 2) { // показал форму
			this.showStep2part(2);
			miniLastStep = true;
			if (firstClick) {
				firstClick = false;
			} else {
				wmFormValidate(document.querySelector('#contact_form'));
				if (isValidStep2()) {
					firstClick = true;
					preparePopUp2();
					showPopUp(2);
				}
			}
		}
	}
	showStep2part(number){
		try	{
			document.querySelector('[data-second-step]:not(.wm-min-hid)').classList.add('wm-min-hid');
		} catch (e){}
		document.querySelector('[data-second-step="'+number+'"]').classList.remove('wm-min-hid');
	}
	stepBackController(e){
		if ( miniClickNumber == 1 ) {
			showPopUp(0);
			miniClickNumber = 0;
			return;
		}
		if ( miniClickNumber == 2 && firstClick ) {
			miniClickNumber = 0;
			this.step2Controller();
			return;
		}
		if ( miniClickNumber == 2 && !firstClick ) {
			miniClickNumber = 1;
			this.step2Controller();
			return;
		}
	}
}

const min = new Min();
const big = new Big();

document.addEventListener('DOMContentLoaded', function(){

	/*calendar*/
	new JustCalendar({
	    container: document.getElementById('calendar'),
	    startDate: new Date(),
	    calendars: 1
	});

	disabledDays();
	/*end  of calendar*/

	if ( getCookie('water_info') ) {
		send_id( getCookie('water_info') );
	}

	if ( order.secondStep.day == null  ) {
		let date = new Date();
		let theDay = date.getDate()+1;
			document.querySelector(`[data-calendar-count="${theDay}"]`).click();
	}
});




function disabledDays(){

	let date = new Date();
	let dayNow = date.getDate();
	let monthNow = date.getMonth();
	let calendarMonth = document.querySelector('[data-month]').getAttribute('data-month');
	let year = date.getFullYear();

	document.querySelectorAll('tbody td div').forEach(function(item, i){
		if ( 
			document.querySelector('.selected-date') == null && 
			order.secondStep.day != null && 
			order.secondStep.month == calendarMonth 
		) {
			
			document.querySelector('.scope[data-calendar-count="' + order.secondStep.day + '"]').classList.add('selected-date');
		}

		if ( monthNames.indexOf(calendarMonth) < monthNow 
			|| document.querySelector('.jajc-calendar [data-year]').getAttribute('data-year') < year
		   ) {
			item.classList.add('disabled-day');
		} else if ( monthNames.indexOf(calendarMonth) == monthNow )  {

			if ( item.hasAttribute('data-calendar-count') && item.getAttribute('data-calendar-count') < dayNow ) {
				item.classList.add('disabled-day');
			}
		}

	}) 
}

document.querySelector('body').addEventListener('click', function(e){
	if ( 
		e.target.closest('.popup-close') != null &&
		e.target.closest('#start-order') == null
		||
		e.target.hasAttribute('data-close-thenk')
	) {
		document.querySelector('main').classList.remove('main--active');
		document.querySelector('.popup-wrap--active').classList.remove('popup-wrap--active');
	}
	if (e.target.closest('.calendar-btn')) {
		disabledDays();
	}
});

document.querySelector('[data-wm-order]').addEventListener('click', function(e){
	wmFormValidate( e.target.closest('form') );
});

function selectWaterType(e){
	// document.querySelector('label.form-item__packet').classList.remove('before-none');

	let name = e.target.getAttribute('data-name').toLowerCase();
	// let name = e.target.innerText.toLowerCase();
	selectedProd = name;
	order.firstStep[selectedProd].count === null ? order.firstStep[selectedProd].count = 1 : '' ; 
	document.querySelector('[data-wm-water-title]').innerText = e.target.innerText;
	document.querySelector('[data-wm-s2-prices]').innerText = priceListClient[selectedProd];
	document.querySelector('[data-calc-attr="count"]').innerText = order.firstStep[selectedProd].count;
	if (order.firstStep[selectedProd].firstTimeComplect) {
		priceNode.innerText = price_start;
		// priceNode.innerText = price_start + priceListSystem[selectedProd];
		document.querySelector('#current-order-img').src = imagesPompa[name];
	} else {
		document.querySelector('label.form-item__packet').classList.add('before-none');
		document.querySelector('#current-order-img').src = images[name];
		priceNode.innerText = priceListSystem[selectedProd];
	}
	fillForm();
	fillDate();
	if (isMinWidth) {
		showPopUp(1);
		min.showPopUp2(e);
	} else {
		showPopUp(1);
	}
}

function fillForm(){
	let form = document.querySelector('#contact_form');
	form.querySelector('[name="mail"]').value = order.secondStep.mail == null ? '' : order.secondStep.mail;
	form.querySelector('[name="phone"]').value = order.secondStep.phone == null ? '' : order.secondStep.phone;
	form.querySelector('[name="fio"]').value = order.secondStep.fio == null ? '' : order.secondStep.fio;
	form.querySelector('[name="adress"]').value = order.secondStep.adress == null ? '' : order.secondStep.adress;
}

function fillDate(){
	if ( order.secondStep.time != null ) {
		document.querySelector('.when-select__item.when-select__item--active').innerText = order.secondStep.time;
		document.querySelector('.wm-select-time').classList.add('wm-hid');
		selectTimeHid = true;
	}
}

function getCookie(name) {
	var matches = document.cookie.match(new RegExp(
		"(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
	));
	return matches ? decodeURIComponent(matches[1]) : undefined;
}

function send_id( id ){
	var xhttp = new XMLHttpRequest();
	xhttp.open('POST', ajaxUrl + '?action=send_id', true);
	xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhttp.send( 'id='+id );
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4) {
			if (xhttp.status == 200) {
				let res = JSON.parse( xhttp.response );
				order.secondStep.mail = res.mail;
				order.secondStep.phone = res.phone;
				order.secondStep.fio = res.fio;
				order.secondStep.adress = res.adress;
			} else {
				wm_ajax_err();
			}
		}
	}
}

function wmFormValidate( form ) {
	is_email( form.querySelector('[name="mail"]') );
	is_phone( form.querySelector('[name="phone"]') );
	is_min_length( form.querySelector('[name="fio"]') );
	is_min_length( form.querySelector('[name="adress"]') );
	if ( document.querySelector('.wm-form-error') == null ) {
		formStep2Valid = true;
		order.secondStep.mail = form.querySelector('[name="mail"]').value;
		order.secondStep.phone = form.querySelector('[name="phone"]').value;
		order.secondStep.fio = form.querySelector('[name="fio"]').value;
		order.secondStep.adress = form.querySelector('[name="adress"]').value;
	} else {
		formStep2Valid = false;
	}
}

function is_email(dom_elem){
	var res = dom_elem.value.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
	if( res != null && dom_elem.value == res[0]){
		dom_elem.classList.remove('wm-form-error');
		return true;
	} else {
		dom_elem.classList.add('wm-form-error');
		return false;
	}
}

function is_phone(dom_elem){
	if (dom_elem.value.length < 6) {
		dom_elem.classList.add('wm-form-error');
		return false;
	}
	var res = dom_elem.value.match(/^(\+)?((\d)+)?( )?([ -(])?((\d)?)+([ -)])?( )?((\d)?)+([ -])?((\d)?)+([ -])?((\d)?)+([ -])?((\d)?)+([ -])?((\d)?)+$/ig);
	if( res != null && dom_elem.value == res[0]){
		dom_elem.classList.remove('wm-form-error');
		return true;
	} else {
		dom_elem.classList.add('wm-form-error');
		return false;
	}
}

function is_min_length(dom_elem){
	if (dom_elem.value.length < dom_elem.getAttribute('data-wm-text')) {
		dom_elem.classList.add('wm-form-error');
		return false;
	} else {
		dom_elem.classList.remove('wm-form-error');
		return true;
	}
}

function toggleFirstTimeComplect(theLabel){
	if ( theLabel.classList.contains('before-none') ) {
		theLabel.classList.remove('before-none');
		order.firstStep[selectedProd].firstTimeComplect = true;

		priceNode.innerText = ( price_start * order.firstStep[selectedProd].count );

	// priceNode.innerText = (priceNode.innerText * 1 + price_start * 1) - priceListSystem[selectedProd] * 1;
		document.querySelector('#current-order-img').src = imagesPompa[selectedProd];
	} else {
		theLabel.classList.add('before-none');
		order.firstStep[selectedProd].firstTimeComplect = false;
		priceNode.innerText = ( priceListSystem[selectedProd] * order.firstStep[selectedProd].count );

		// priceNode.innerText = (priceNode.innerText * 1 - price_start * 1) +  * 1;
		document.querySelector('#current-order-img').src = images[selectedProd];
	}
}

function calculatorController(e){
	if (e.target.getAttribute('data-calc-attr') == 'add') {
		addProduct();
	} else if ( e.target.getAttribute('data-calc-attr') == 'minus' ) {
		minusProduct();
	}
}

function minusProduct(){
	if (order.firstStep[selectedProd].count <= 1) {
		return;
	}
	if (order.firstStep[selectedProd].firstTimeComplect) {
		priceNode.innerText = priceNode.innerText * 1 - price_start * 1;
	} else {
		priceNode.innerText = priceNode.innerText * 1 - priceListSystem[selectedProd] * 1;
	}
	--order.firstStep[selectedProd].count;
	calcCount.innerText = order.firstStep[selectedProd].count;
}

function addProduct(){
	if (order.firstStep[selectedProd].firstTimeComplect) {
		priceNode.innerText = priceNode.innerText * 1 + price_start * 1;
	} else {
		priceNode.innerText = priceNode.innerText * 1 + priceListSystem[selectedProd] * 1;
	}
	++order.firstStep[selectedProd].count;
	calcCount.innerText = order.firstStep[selectedProd].count;
}

function controllerCalendarCurrent(e){
	let date = new Date();
	let dayNow = date.getDate();
	if ( 
		e.target.closest('[data-calendar-count]').getAttribute('data-calendar-count') <= dayNow 
		&& window.currenMonth <= 0 
	) {
		return;
	}
	order.secondStep.day = e.target.closest('[data-calendar-count]').getAttribute('data-calendar-count');
	order.secondStep.month = e.target.closest('.jajc-calendar').querySelector('.month-name').getAttribute('data-month');
	try {
		document.querySelector('.selected-date').classList.remove('selected-date');
	} catch (e) {}
	e.target.closest('[data-calendar-count]').classList.add('selected-date');
}

function controllerCalendarNext(e){
	order.secondStep.day = e.target.closest('[data-calendar-count-next]').getAttribute('data-calendar-count-next');
	order.secondStep.month = e.target.closest('.jajc-calendar').querySelector('.month-name').getAttribute('data-next-month');
	try {
		document.querySelector('.selected-date').classList.remove('selected-date');
	} catch (e) {}
	e.target.closest('[data-calendar-count-next]').classList.add('selected-date');
}

function isValidStep2(){
	let valid = true;
	Object.keys(order.secondStep).forEach(function(item){
		if(order.secondStep[item] == null){
			valid = false;
		}
	});
	return valid;
}

function preparePopUp2(){
	Object.keys(order.firstStep).forEach(function(item, i){
		if ( order.firstStep[item].count != null ) {
			let itemRow = document.querySelector('[data-wm-name="' + item + '"]');
			itemRow.querySelector('.offer-item__img img').src = images[item];
			itemRow.classList.remove('wm-hid');
			let deliveryTime = order.secondStep.time;
			deliveryTime +=' (' + ( order.secondStep.day.length == 1 ? '' + 0 + order.secondStep.day : order.secondStep.day ) + '.';
			let monthView = monthNames.indexOf(order.secondStep.month) + 1;
			deliveryTime += ( monthView < 10 ? '' + 0 + monthView : monthView );
			deliveryTime += ')';
			itemRow.querySelector('[data-delivery-date]').innerText = deliveryTime;
			itemRow.querySelector('[data-itm-count]').innerText = order.firstStep[item].count;
			let priceSingle = itemRow.querySelector('[data-price-single]');
			let priceTotal = itemRow.querySelector('[data-price-total]');
			if ( order.firstStep[item].firstTimeComplect ) {
				itemRow.querySelector('.offer-item__img img').src = imagesPompa[item];
				priceSingle.innerText = price_start;
				priceTotal.innerText = order.firstStep[item].count * price_start;
			} else {
				priceSingle.innerText = priceListSystem[item];
				priceTotal.innerText = order.firstStep[item].count * priceListSystem[item]; 
			}
			// priceSingle.innerText = priceListSystem[item];
			// priceTotal.innerText = ( order.firstStep[item].count * 1 ) * ( priceListSystem[item] * 1 );
			// itemRow.querySelector('[data-itm-count]').innerText = order.firstStep[item].count;
			// if ( order.firstStep[item].firstTimeComplect ) {
			// 	itemRow.querySelector('[data-complect-first]').classList.remove('wm-hid');
			// 	itemRow.querySelector('.offer-item__img img').src = imagesPompa[item];
			// 	itemRow.querySelector('[data-itm-count]').innerText 
			// 		=
			// 	order.firstStep[item].count == 1 ?'1': order.firstStep[item].count - 1 + ' + 1';
			// 	if (order.firstStep[item].count > 1) {
			// 		priceSingle.innerText = priceListSystem[item] + ' / '+ price_start;
			// 		priceTotal.innerText = priceTotal.innerText - priceListSystem[item];
			// 		priceTotal.innerText = priceTotal.innerText + ' + ' + price_start;
			// 	} else {
			// 		priceSingle.innerText = price_start;
			// 		priceTotal.innerText = price_start ;
			// 	}
			// }
		} else {
			let itemRow = document.querySelector('[data-wm-name="' + item + '"]').classList.add('wm-hid');;
		}
	});
	    document.querySelector('#adress-rezult').innerText = order.secondStep.fio + ', ' + order.secondStep.adress + '.';
	    updateOrderTotalPrice();
};

function updateOrderTotalPrice(){
	totalOrder = [];
	Object.keys(order.firstStep).forEach(function(item, i){
		if ( order.firstStep[item].count != null ) {
			if ( order.firstStep[item].firstTimeComplect ) {
				totalOrder.push( price_start * 1 * ( order.firstStep[item].count * 1 ) );
			} else {
				totalOrder.push( ( order.firstStep[item].count * 1 ) * ( priceListSystem[item] * 1 ) );
			}
		}
	});
	let sum = 0;
	for(let i = 0; i < totalOrder.length; i++){
	    sum += totalOrder[i] * 1;
    }
    document.querySelector('#order-total').innerText = sum;
    document.querySelector('#order-total2').innerText = sum;

}


function sendOrder(){
	var xhttp = new XMLHttpRequest();
	xhttp.open('POST', ajaxUrl + '?action=send_order', true);
	xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhttp.send( 'data='+JSON.stringify(order) );
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4) {
			if (xhttp.status == 200) {
				let obj = JSON.parse(xhttp.response );
				if(obj.success){
					if (order.secondStep.payCart) {
						document.querySelector('#pay-btn--hid').innerHTML = obj.liqbtn;
						document.querySelector('#pay-btn--hid form').submit();
					} else {
						document.querySelector('#pay-btn').classList.add('wm-hid');
						document.querySelector('.popup-wrap--active').classList.remove('popup-wrap--active');
						document.querySelector('[data-popup-thenk]').classList.add('popup-wrap--active');
						// document.querySelector('#pay-btn').classList.remove('wm-hid');
					}
					Object.keys(order.firstStep).forEach(function(itm){
					    order.firstStep[itm].count = null
					})
				} else {
					alert('Что-то опшло не так, попробуйте позже'); 
				}
			} else {
				wm_ajax_err();
			}
		}
	}
}

function prepareLiqBtn(){
	var xhttp = new XMLHttpRequest();
	xhttp.open('POST', ajaxUrl + '?action=prepare_liq_btn', true);
	xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhttp.send( 'data='+JSON.stringify(order) );
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4) {
			if (xhttp.status == 200) {
				let obj = JSON.parse(xhttp.response );
				if(obj.success){
					document.querySelector('#pay-btn').innerHTML = obj.data;
				} else {
					alert('Что-то опшло не так, попробуйте позже');
				}
			} else {
				wm_ajax_err();
			}
		}
	}
}

document.querySelector('.popup.popup3').addEventListener('click', function(e){
	if ( e.target.getAttribute('data-confirm-order') == "btn-3" ) {
		// document.querySelector('#pay-btn [type="image"]').click();
		sendOrder();
	}
	if ( e.target.closest('[data-confirm-order-back]')) {
		showPopUp(1);
		if (isMinWidth()) {
			miniClickNumber = 2;
			min.step2Controller();
		}
	} 
});

document.querySelector('#pay-btn').addEventListener('click', function(e){
	document.querySelector('#pay-btn--hid form').submit()
})

document.querySelector('#pay-cart').addEventListener('click', function(e){
	document.querySelector('#pay-cart [data-pay-cart]').classList.toggle('pay-cart-not-active');
	order.secondStep.payCart = !order.secondStep.payCart;
})

// document.querySelector('#calendar-btn-previous').addEventListener('click', function(e){
// 	document.querySelector('td.calendar-btn.btn-prev > span').click();
// 	setTimeout(disabledDays, 200);
// })

// document.querySelector('#calendar-btn-next').addEventListener('click', function(e){
// 	document.querySelector('td.calendar-btn.btn-next > span').click();
// 	setTimeout(disabledDays, 200);
// })

