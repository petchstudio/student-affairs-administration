@extends('layouts.member')

@section('link')
    @parent
    <link href="{{ asset('assets/js/plugins/jquery.bootgrid/1.3.1/jquery.bootgrid.min.css') }}" rel="stylesheet">
@stop

@section('script')
    @parent
    <script src="{{ asset('assets/member/js/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/member/js/datepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/member/vendors/validator/validator.min.js') }}"></script>
    <script type="text/javascript">
    	$(document).ready(function(){
    		$('#event-start').daterangepicker({
    			format: 'DD/MM/YYYY',
    			singleDatePicker: true,
    			calender_style: "picker_1"
    		});

    		// initialize the validator function
    		validator.message.date = 'not a real date';

    		// validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
    		$('form')
    		.on('blur', 'input[required], input.optional, select.required', validator.checkField)
    		.on('change', 'select.required', validator.checkField)
    		.on('keypress', 'input[required][pattern]', validator.keypress);

    		$('.multi.required').on('keyup blur', 'input', function() {
    			validator.checkField.apply($(this).siblings().last()[0]);
    		});

    		$('form').submit(function(e) {
    			e.preventDefault();
    			var submit = true;

    			// evaluate the form using generic validaing
    			if (!validator.checkAll($(this))) {
    				submit = false;
    			}

    			if (submit)
    				this.submit();

    			return false;
    		});
		});
    </script>
@stop

@section('container')
	<div class="">
	
		@include('includes.alert-response-session')

		<div class="page-title">
			<div class="title_left">
				<h3>เพิ่มประเภทกิจกรรม</h3>
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_content">
						<form class="form-horizontal form-label-left" action="{{ url('member/activities-category/'.$activities->id) }}" method="POST" novalidate>
							{!! csrf_field() !!}
							{{ method_field('PUT') }}

							<span class="section">ข้อมูลประเภทกิจกรรม</span>

							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="input-name">
									ชื่อประเภทกิจกรรม <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="input-name" class="form-control col-md-7 col-xs-12" type="text" name="name" required="required" value="{{ old('name', $activities->name) }}">
								</div>
							</div>

							<div class="ln_solid"></div>

							<div class="item form-group">
								<div class="col-md-6 col-md-offset-3">
									<button id="send" type="submit" class="btn btn-success">แก้ไขประเภทกิจกรรม</button>
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection