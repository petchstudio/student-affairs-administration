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
				<h3>เพิ่มกิจกรรม</h3>
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_content">
						<form class="form-horizontal form-label-left" action="{{ url('member/activities') }}" method="POST" novalidate>
							{!! csrf_field() !!}

							<span class="section">ข้อมูลกิจกรรม</span>

							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="input-name">
									ชื่อกิจกรรม <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="input-name" class="form-control col-md-7 col-xs-12" type="text" name="name" required="required">
								</div>
							</div>

							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="input-description">
									รายละเอียดกิจกรรม <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<textarea id="input-description" class="form-control col-md-7 col-xs-12" name="description" required="required"></textarea>
								</div>
							</div>

							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="input-description">
									ประเภทกิจกรรม <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select class="selectpicker" name="category">
										@foreach(App\ActivitiesCategory::all() as $value)
											<option value="{{ $value->id }}">{{ $value->name }}</option>
										@endforeach
									</select>
								</div>
							</div>

							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="input-description">
									เทอม <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select class="selectpicker" name="term">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
									</select>
								</div>
							</div>

							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="input-description">
									ปีการศึกษา <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select class="selectpicker" name="year">
										@for($i=(date('Y')+10); $i>(date('Y')-5); $i--)
											<option value="{{ $i }}"{!! $i == date('Y') ? ' selected="selected"':'' !!}> {{ $i+543 }}</option>
										@endfor
									</select>
								</div>
							</div>

							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="input-name">
									วันที่จัดกิจกรรม <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" style="width: 200px" name="event-start" id="event-start" class="form-control" required="required" />
								</div>
							</div>

							<span class="section">กำหนดผู้เข้าร่วมกิจกรรม</span>

							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="input-generation">
									รุ่น <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select class="selectpicker" name="generation">
										<option value="0">ทุกรุ่น</option>
										@for($i=date('y')+44; $i>=date('y')+39; $i--)
											<option value="{{ $i }}">{{ $i }}</option>
										@endfor
									</select>
								</div>
							</div>

							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="input-section">
									ตอนเรียน <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select class="selectpicker" name="section">
										<option value="0">ทุกตอนเรียน</option>
                                        <option value="a1"{!! old('section') == 'a1' ? ' selected':'' !!}>A1</option>
                                        <option value="b1"{!! old('section') == 'b1' ? ' selected':'' !!}>B1</option>
                                        <option value="c1"{!! old('section') == 'c1' ? ' selected':'' !!}>C1</option>
									</select>
								</div>
							</div>

							<div class="ln_solid"></div>

							<div class="item form-group">
								<div class="col-md-6 col-md-offset-3">
									<button id="send" type="submit" class="btn btn-success">เพิ่มกิจกรรม</button>
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection