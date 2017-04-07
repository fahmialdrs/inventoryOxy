$(document).ready(function () {
	//confirm delete

	$(document.body).on('submit', '.js-confirm', function (){
		var $el = $(this)
		var text = $el.data('confirm') ? $el.data('confirm') : 'Are you sure want to delete ?'
		var c = confirm(text);
		return c;
	});
});