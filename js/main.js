
// var rb = '';
var rb = new Ratebox({IBEUrl: 'hampshire-hotel-mijdrecht', key: '79ACA542-6611-4E9F-AD3A-D820868E97F6', locale: 'en' });

jQuery(function ($) {
	function show_ratebox() {
		var top_offset = $(this).scrollTop();

		if (top_offset > 128) {
			$('.cubilis-ratebox').addClass('show');
		}
	};

	$(window).scroll(function () {
		show_ratebox();
	});
});