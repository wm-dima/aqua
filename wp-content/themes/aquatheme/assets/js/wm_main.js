'use strict'

let order = {
	firstStep: {
		'аквастар':{
			count: null,
			firstTimeComplect: true
		},
		'благодатна':{
			count: null,
			firstTimeComplect: true
		},
		'магазин':{
			count: null,
			firstTimeComplect: true
		}
	},
	secondStep: {
		mail: null,
		phone: null,
		fio: null,
		adress: null
	}
};

let formStep2Valid = false;
let priceNode = document.querySelector('.card-wrap__total span');
let selectedProd = null;
let calcCount = document.querySelector('[data-calc-attr="count"]');

document.querySelector('#start-order').addEventListener('click', function(e){
	e.preventDefault();
	showPopUp(0);
});

document.querySelector('.popup.popup1').addEventListener('click', function(e){
	if ( e.target.classList.contains('direction-item__button') ) {
		let name = e.target.innerText.toLowerCase();
		selectedProd = name;
		document.querySelector('[data-wm-water-title]').innerText = e.target.innerText;
		document.querySelector('[data-wm-s2-prices]').innerText = priceListClient[selectedProd];
		priceNode.innerText = price_start + priceListSystem[selectedProd];
		fillForm();
		showPopUp(1);
	}
});

function fillForm(){
	let form = document.querySelector('#contact_form');
	form.querySelector('[name="mail"]').value = order.secondStep.mail == null ? '' : order.secondStep.mail;
	form.querySelector('[name="phone"]').value = order.secondStep.phone == null ? '' : order.secondStep.phone;
	form.querySelector('[name="fio"]').value = order.secondStep.fio == null ? '' : order.secondStep.fio;
	form.querySelector('[name="adress"]').value = order.secondStep.adress == null ? '' : order.secondStep.adress;
}

document.querySelector('.popup.popup2').addEventListener('click', function(e){
	if ( e.target.hasAttribute('data-wm-order') ) {
		e.preventDefault();		
		wmFormValidate( e.target.closest('form') );
	}
	if (e.target.closest('.form-item__packet') != null) {
		toggleFirstTimeComplect(e.target.closest('.form-item__packet'));
	}
	if (e.target.hasAttribute('data-calc-attr')) {
		calculatorController(e);
	}
	if (e.target.getAttribute('data-wm-go') == 'step-3') {
		document.querySelector('[data-wm-order="save"]').click();
		if (isValidStep2()) {
			preparePopUp2();
			showPopUp(2);
		};
	}
});

function preparePopUp2(){
	Object.keys(order.firstStep).forEach(function(item, i){
		if ( order.firstStep[item].count != null ) {
			let itemRow = document.querySelector('[data-wm-name="' + item + '"]');
			itemRow.classList.remove('wm-hid');
			itemRow.querySelector('[data-price-single]').innerText = priceListSystem[item];
			itemRow.querySelector('[data-itm-count]').innerText = order.firstStep[item].count;
			itemRow.querySelector('[data-price-total]').innerText = ( order.firstStep[item].count * 1 ) * ( priceListSystem[item] * 1 );
		}
	});
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

function calculatorController(e){
	if (e.target.getAttribute('data-calc-attr') == 'add') {
		addProduct();
	} else {
		minusProduct();
	}
}

function minusProduct(){
	if (order.firstStep[selectedProd].count <= 1) {
		return;
	}
	priceNode.innerText = priceNode.innerText * 1 - priceListSystem[selectedProd] * 1;
	try{
		--order.firstStep[selectedProd].count;
	} catch (e){
		order.firstStep[selectedProd].count = 1;
	}
	calcCount.innerText = order.firstStep[selectedProd].count;
}

function addProduct(){
	priceNode.innerText = priceNode.innerText * 1 + priceListSystem[selectedProd] * 1;
	try{
		++order.firstStep[selectedProd].count;
	} catch (e){
		order.firstStep[selectedProd].count = 1;
	}
	calcCount.innerText = order.firstStep[selectedProd].count;
}

function toggleFirstTimeComplect(theLabel){
	if ( theLabel.classList.contains('before-none') ) {
		theLabel.classList.remove('before-none');
		order.firstStep[selectedProd].firstTimeComplect = true;
		priceNode.innerText = priceNode.innerText * 1 + price_start * 1;
	} else {
		theLabel.classList.add('before-none');
		order.firstStep[selectedProd].firstTimeComplect = false;
		priceNode.innerText = priceNode.innerText * 1 - price_start * 1;
	}
}

function showPopUp( numberSelector ){
	try{
		document.querySelector('.popup-wrap--active').classList.remove('popup-wrap--active');
	} catch (e){}
	document.querySelectorAll('.popup-wrap')[numberSelector].classList.add('popup-wrap--active');
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
	var res = dom_elem.value.match(/^([\w]?)+(\.){0,2}([\w]?)+(@)([\w]?)+(\.)([\w]?)+$/ig);
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


document.querySelector('body').addEventListener('click', function(e){
	if ( 
		e.target.closest('.popup-close') != null &&
		e.target.closest('#start-order') == null
	) {
		document.querySelector('.popup-wrap--active').classList.remove('popup-wrap--active');
	}
});

document.addEventListener('DOMContentLoaded', function(){

	/*calendar*/
	new JustCalendar({
	    container: document.getElementById('calendar'),
	    startDate: new Date(),
	    calendars: 1
	});
	/*end  of calendar*/

});