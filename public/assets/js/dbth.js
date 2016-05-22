$(document).ready(function() {
	/*
     * Fill Address
     */
	var getDBTH = function(elm) {
		var target = elm.data('target');

		if( target == 'zipcode') {
			$('#input-zipcode').val(elm.find('option:selected').data('zipcode'));
			return true;
		}

		$('#select-' + target).prop('disabled', true).html('<option>กำลังโหลด...</option>');
		$('.selectpicker').selectpicker('refresh');

		$.get( elm.data('url')+'/' + target, {
			id: elm.find('option:selected').val()
		}, function( data ) {
			var options = '';

			$.each(data, function(index, val) {
				var zipcode = '';

				if( target == 'district') {
					zipcode = ' data-zipcode="' + val.zipcode +'"';
				}
					
				options += '<option value="' + val.id +'"' + zipcode + '>' + val.name +'</option>';
			});

			$('#select-' + target).prop('disabled', false).html(options);
			$('.selectpicker').selectpicker('refresh');

			getDBTH($('#select-' + target));
		}, "json" );
	}

	
	$('select.selectpicker').on('change', function(){
		getDBTH($(this));
	});
});