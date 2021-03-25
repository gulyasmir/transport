$(document).ready(function () {
	// mobile-menu
	$('.bars, .mobile-close, .mobile-menu li a').click(function () {
		$('.mobile-menu-wrap').toggleClass('el-active');
	})
	$(document).mouseup(function (e){ // событие клика по веб-документу
		var div = $(".mobile-menu-wrap"); // тут указываем ID элемента
		if (!div.is(e.target) // если клик был не по нашему блоку
		    && div.has(e.target).length === 0
		    && $(".mobile-menu-wrap").hasClass("el-active")) { // и не по его дочерним элементам
			$('.mobile-menu-wrap').toggleClass('el-active'); // выполняем действие
		}
	});
	// SEARCH
	$('.search__btn').click(function () {
		if ($('.search__input').css('display') == 'none') {
			$('.search__input').css('display', 'block');
			$('.search__input').animate({
				'width': '272px'
			}, 100);
		} else {
			$('.search__input').css({
				'display': 'none',
				'width': '50px'
			});
		}
	})
	// TABS
	var el_tabs	 = $('.serv-list li'),
		el_index = null,
		el_block = $('.serv-descr');
	for (var i = el_tabs.length - 1; i >= 0; i--) {
		$('.serv-list li').eq(i).click(function () {
			el_tabs.removeClass('el-active');
			$(this).addClass('el-active');
			el_index = $(this).index();
			el_block.removeClass('el-active');
			el_block.eq(el_index).addClass('el-active');
		})
	};

	//ORDER
	// main tabs
	$('button#cargo-button, button#dedicated-button').click(function () {

		if (!$(this).hasClass('selected')) {

			$('.transport-mode-tab').removeClass('selected');
			$(this).addClass('selected');

			var tab_content = $(this).attr('tab_content');
			$('.order-section .tab').stop().hide();
			$('.order-section .tab.' + tab_content).stop().show();
			$('#main-tab-hidden').val(tab_content);

			// cookies tabs
			if ($(this).attr('id') == 'cargo-button') {
				set_cookie('order_tab', 'cargo', 7);
				if (typeof get_cookie('order_subtab_cargo') == "undefined") {
					set_cookie('order_subtab_cargo', 'one', 7);
				}
			} else if ($(this).attr('id') == 'dedicated-button') {
				set_cookie('order_tab', 'dedicated', 7);
				if (typeof get_cookie('order_subtab_dedicated') == "undefined") {
					set_cookie('order_subtab_dedicated', 'truck', 7);
				}
			}
		}
	});

	// sender
	$('#individual-entity-radio-sender .radio input[type=radio]').click(function () {
		var subtab_content = $(this).val();
		$('.individual-entity-sender .individual-sender.subtab').hide();
		$('.individual-entity-sender .entity-sender.subtab').hide();
		$('.individual-entity-sender .address-sender.subtab').hide();
		$('.individual-entity-sender .' + subtab_content + '.subtab').show();
	});
	// entity
	$('#individual-entity-radio-recipient .radio input[type=radio]').click(function () {
		var subtab_content = $(this).val();
		$('.individual-entity-recipient .individual-recipient.subtab').hide();
		$('.individual-entity-recipient .entity-recipient.subtab').hide();
		$('.individual-entity-recipient .address-recipient.subtab').hide();
		$('.individual-entity-recipient .' + subtab_content + '.subtab').show();
	});

	// client tabs
	$('#info-button').click(function () {
		$('#info-button').addClass('selected');
		$('#cooperation-button').removeClass('selected');
		$('#reference-button').removeClass('selected');
		$('.info.tab').show();
		$('.cooperation.tab').hide();
		$('.reference.tab').hide();
	});
	$('#cooperation-button').click(function () {
		$('#info-button').removeClass('selected');
		$('#cooperation-button').addClass('selected');
		$('#reference-button').removeClass('selected');
		$('.info.tab').hide();
		$('.cooperation.tab').show();
		$('.reference.tab').hide();
	});
	$('#reference-button').click(function () {
		$('#info-button').removeClass('selected');
		$('#cooperation-button').removeClass('selected');
		$('#reference-button').addClass('selected');
		$('.info.tab').hide();
		$('.cooperation.tab').hide();
		$('.reference.tab').show();
	});

	// cargo composition
	$('.cargo-composition .radio input[type=radio]').click(function () {
		var subtab_content = $(this).val();
		$('.cargo.tab .subtab').hide();
		$('.cargo.tab .' + subtab_content + '.subtab').show();

		// cookies subtabs
		set_cookie('order_subtab_cargo', subtab_content, 7);
	});

	// shipping types
	$('.shipping-types .radio input[type=radio]').click(function () {
		var subtab_content = $(this).val();
		$('.dedicated.tab .subtab').hide();
		$('.dedicated.tab .' + subtab_content + '.subtab').show();

		// cookies subtabs
		set_cookie('order_subtab_dedicated', subtab_content, 7);
	});

	// volume calculation one subtab
	$('.one .сargo-dimensions, .one .calculate-length, .one .сargo-dimensions, .one .calculate-width, .one .сargo-dimensions, .one .calculate-height').keyup(function () {
		var length = $('.one .сargo-dimensions .calculate-length').val();
		var width = $('.one .сargo-dimensions .calculate-width').val();
		var height = $('.one .сargo-dimensions .calculate-height').val();

		if (!isNaN(length) && parseInt(length) > 0 && !isNaN(width) && parseInt(width) > 0 && !isNaN(height) && parseInt(height) > 0) {
			$('.one .weight-volume .calculate-volume').attr('value', (parseFloat(length) + parseFloat(width) + parseFloat(height)).toString());
		} else {
			$('.one .weight-volume .calculate-volume').attr('value', '');
		}
	});

	// volume calculation letter subtab
	$('.letter .сargo-dimensions, .letter .calculate-length, .letter .сargo-dimensions, .letter .calculate-width, .letter .сargo-dimensions, .letter .calculate-height').keyup(function () {
		var length = $('.letter .сargo-dimensions .calculate-length').val();
		var width = $('.letter .сargo-dimensions .calculate-width').val();
		var height = $('.letter .сargo-dimensions .calculate-height').val();

		if (!isNaN(length) && parseInt(length) > 0 && !isNaN(width) && parseInt(width) > 0 && !isNaN(height) && parseInt(height) > 0) {
			$('.letter .weight-volume .calculate-volume').attr('value', (parseFloat(length) + parseFloat(width) + parseFloat(height)).toString());
		} else {
			$('.letter .weight-volume .calculate-volume').attr('value', '');
		}
	});

	// only num
/*	$('.order-num').on('keydown', function(e){
		if(e.key.length == 1 && e.key.match(/[^0-9'".]/)){
			return false;
		};
	});
	*/

	$('.order-num').on('keydown', function(e){
			let value = $(this).val();
	  $(this).val(value.replace(",", '.'));
	});
	// alert success
	$('.alert-success button.close').on('click', function(e){
		$('.alert-success').hide();
	});

	// tent
	$('#shipping-radio-0').on('click', function(e){
		$('#shipping-types-radio .tent').show();
	});
	$('#shipping-radio-1').on('click', function(e){
		$('#shipping-types-radio .tent').hide();
	});

	// one place mode
	$('#one-place-mode').on('click', function(e){
		$('#cargo-composition-radio input[value=one]').trigger('click');
		return false;
	});

	// geo city
	$('#yes_button').on('click', function(e) {
		$('.city .bubble').hide();
		set_cookie('geo_city_confirmed', 1, 7);
	});
	$('#yes_save_button').on('click', function(e) {
		var city = $('#geo_city_input_new').val();
		if (city != '') {
			$('.city__text').html(city);
			set_cookie('geo_city', encodeURIComponent(city), 7);
			set_cookie('geo_city_confirmed', 1, 7);
			$('.city .bubble').hide();

		} else {
			alert('Необходимо ввести город.');
		}
	});
	$('#no_button').on('click', function(e) {
		$('.city .bubble p').text('Введите ваш город:');
		$('#geo_city_input').show();
		$('#geo_city_button').show();
		$('#yes_button').hide();
		$('#no_button').hide();
	});
	$('#no_cancel_button').on('click', function(e) {
		$('.city .bubble').hide();
		set_cookie('geo_city_confirmed', 1, 7);
	});
	$('#geo_city_button').on('click', function(e) {
		var city = $('#geo_city_input').val();
		if (city != '') {
			$('.city__text').html(city);
			set_cookie('geo_city', encodeURIComponent(city), 7);
			set_cookie('geo_city_confirmed', 1, 7);
			$('.city .bubble').hide();

		} else {
			alert('Необходимо ввести город.');
		}
	});
});


function get_cookie(name) {
	var v = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
	return v ? v[2] : null;
}

function set_cookie(name, value, days) {
	var d = new Date;
	d.setTime(d.getTime() + 24*60*60*1000*days);
	document.cookie = name + "=" + value + ";path=/;expires=" + d.toGMTString();
}

function deleteCookie(name) {
	setCookie(name, '', -1);
}
