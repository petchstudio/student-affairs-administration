$(document).ready(function(){
	$.validator.setDefaults({
	    highlight: function(element) {
	        $(element).closest('.form-group').addClass('has-error');
	    },
	    unhighlight: function(element) {
	        $(element).closest('.form-group').removeClass('has-error');
	    },
	    errorElement: 'span',
	    errorClass: 'help-block',
	    errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else if(element.next('label, .bootstrap-select').length) {
                error.insertAfter(element.next());
            } else if(element.parents('.fileinput').length) {
                element.parents('.fileinput').append(error)
            } else {
	            error.insertAfter(element);
	        }
	    }
	})
});
