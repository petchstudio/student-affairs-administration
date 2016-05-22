$(document).ready(function(){
	/*
     * Select Plan
     */
    var selectPlan = function(elm) {
    	var ptWrap = $('input[name="plan"]:checked').parents('.pt-wrap');

    	$('.pt-wrap').removeClass('selected');
    	ptWrap.addClass('selected');
    };

    selectPlan();

    $('input[name="plan"]').on('change', function(){
    	selectPlan();
    });


	if( $('#select-province option:selected').val() != 0) {
		getDBTH($('#select-province'));
	}




	/*
     * jQuery Validation
     */
	$('#form-register').validate({
		ignore: '',
        rules: {
            'name-company': {
                required: true,
            },
            tel: {
                required: true,
            },
            province: {
                required: true,
            },
            city: {
                required: true,
            },
            district: {
                required: true,
            },
            zipcode: {
                required: true,
            },
            address: {
                required: true,
            },
            'file-logo': {
                required: true,
                extension: "png|jpe?g|gif"
            },
            'file-com-reg': {
                required: true,
                extension: "png|jpe?g|gif"
            },
            email: {
                required: true,
                remote: "api/check-email"
            },
            password: {
                required: true,
                rangelength: [6, 30],
            },
            password_confirmation: {
                required: true,
                equalTo: "#input-password",
            },
            terms: {
                required: true,
            },
        },
        messages: {
            'name-company': {
                required: "โปรดป้อนชื่อบริษัท/องค์กร",
            },
            tel: {
                required: "โปรดป้อนหมายเลขโทรศัพท์ของบริษัทหรือองค์กร",
            },
            province: {
                required: "โปรดระบุจังหวัด",
            },
            city: {
                required: "โปรดระบุเขต/อำเภอ",
            },
            district: {
                required: "โปรดระบุแขวง/ตำบล",
            },
            zipcode: {
                required: "โปรดป้อนรหัสไปรษณีย์",
            },
            zipcode: {
                required: "โปรดป้อนรหัสไปรษณีย์",
            },
            address: {
                required: "โปรดป้อนที่อยู่",
            },
            'file-logo': {
                required: "โปรดใส่โลโก้",
                extension: "รูปแบบไฟล์ไม่ถูกต้อง",
            },
            'file-com-reg': {
                required: "โปรดใส่ใบทะเบียนพาณิชย์",
                extension: "รูปแบบไฟล์ไม่ถูกต้อง",
            },
            email: {
                required: "โปรดป้อนีเมล",
                remote: "อีเมลนี้มีอยู่แล้วในระบบ"
            },
            password: {
                required: "โปรดป้อนรหัสผ่าน",
                rangelength: "รหัสผ่านต้องมีความยาว 6-30 ตัวอักษร",
            },
            password_confirmation: {
                required: "โปรดป้อนยืนยันรหัสผ่าน",
                equalTo: "ยืนยันรหัสผ่านไม่ถูกต้อง",
            },
            terms: {
                required: "ในการใช้บริการ โปรดยอมรับเงื่อนไขการใช้งาน",
            },
        },
        onkeyup: false
    });
});