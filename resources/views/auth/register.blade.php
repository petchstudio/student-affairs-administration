@extends('layouts.app')

@section('link')
    @parent
    <link href="{{ asset('assets/js/plugins/silviomoreto-bootstrap-select/1.7.2-0/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
@stop

@section('script')
    @parent
    <script src="{{ asset('assets/js/plugins/silviomoreto-bootstrap-select/1.7.2-0/dist/js/bootstrap-select.min.js') }}"></script>
@stop


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">สมัครสมาชิก</div>
                <div class="panel-body">
                
                    @include('includes.alert-response-session')
                    
                    @if (Request::has('type'))
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('register') }}">
                            {!! csrf_field() !!}

                            <input type="hidden" name="type" value="{{ Request::input('type') }}">

                            <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">ประเภท</label>

                                <div class="col-md-6">
                                    <input value="{{ App\User::getType(Request::input('type')) }}" class="form-control" readonly="readonly">
                                </div>
                            </div>

                            @if (Request::input('type') == 'student')
                            <div class="form-group{{ $errors->has('section') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">ตอนเรียน</label>

                                <div class="col-md-3 col-lg-2">
                                    <select class="selectpicker" name="section">
                                        <option value="a1"{!! old('section') == 'a1' ? ' selected':'' !!}>A1</option>
                                        <option value="b1"{!! old('section') == 'b1' ? ' selected':'' !!}>B1</option>
                                        <option value="c1"{!! old('section') == 'c1' ? ' selected':'' !!}>C1</option>
                                    </select>

                                    @if ($errors->has('section'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('section') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @endif

                            <div class="form-group{{ $errors->has('sdu-id') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">รหัส{{ App\User::getType(Request::input('type')) }}</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="sdu-id" value="{{ old('sdu-id') }}" maxlength="20">

                                    @if ($errors->has('sdu-id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('sdu-id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">รหัสผ่าน</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">ยืนยันรหัสผ่าน</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password_confirmation">

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">อีเมล</label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">ชื่อ</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="firstname" value="{{ old('firstname') }}">

                                    @if ($errors->has('firstname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('firstname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">นามสกุล</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="lastname" value="{{ old('lastname') }}">

                                    @if ($errors->has('lastname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('lastname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('tel') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">เบอร์โทร</label>

                                <div class="col-md-5 col-lg-4">
                                    <input type="text" class="form-control" name="tel" value="{{ old('tel') }}">

                                    @if ($errors->has('tel'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('tel') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            @if (Request::input('type') == 'student')
                            <div class="form-group{{ $errors->has('tel-parent') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">เบอร์โทรผู้ปกครอง</label>

                                <div class="col-md-5 col-lg-4">
                                    <input class="form-control" name="tel-parent" value="{{ old('tel-parent') }}">

                                    @if ($errors->has('tel-parent'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('tel-parent') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">ที่อยู่</label>

                                <div class="col-md-6">
                                    <textarea class="form-control" name="address">{{ old('address') }}</textarea>

                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('birth-day') || $errors->has('birth-month') || $errors->has('birth-year') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">วัน/เดือน/ปี</label>

                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <select id="select-birth-day" name="birth-day" class="selectpicker" data-width="100%">
                                                <option{!! old('birth-day') ? '':' selected="selected"' !!} value="0" disabled="disabled">วัน</option>
                                                @for($i=1; $i<=31; $i++)
                                                    <option value="{{ $i }}"{!! $i == old('birth-day') ? ' selected':'' !!}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-xs-4">
                                            <select id="select-birth-month" name="birth-month" class="selectpicker" data-width="100%">
                                                <option{!! old('birth-month') ? '':' selected="selected"' !!} value="0" disabled="disabled">เดือน</option>
                                                @for($i=1; $i<=12; $i++)
                                                    <option value="{{ $i }}"{!! $i == old('birth-month') ? ' selected':'' !!}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-xs-4">
                                            <select id="select-birth-year" name="birth-year" class="selectpicker" data-width="100%">
                                                <option{!! old('birth-year') ? '':' selected="selected"' !!} value="0" disabled="disabled">ปี</option>
                                                @for($i=date('Y'); $i>=(date('Y')-100); $i--)
                                                    <option value="{{ $i }}"{!! $i == old('birth-year') ? ' selected':'' !!}>{{ $i+543 }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>

                                    @if ($errors->has('birth-day') || $errors->has('birth-month') || $errors->has('birth-year'))
                                        <span class="help-block">
                                            <strong>โปรดระบุ วัน/เดือน/ปี เกิด</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @endif

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-block btn-primary">
                                        ลงทะเบียน
                                    </button>
                                </div>
                            </div>
                        </form>
                    @else
                        <h1 class="text-center">เลือกประเภทสมาชิก</h1>
                        <div class="row">
                            <div class="col-sm-6 text-center">
                                <a href="{{ url('register?type=student') }}" class="btn btn-block btn-lg btn-primary">นักศึกษา</a>
                            </div>
                            <div class="col-sm-6 text-center">
                                <a href="{{ url('register?type=teacher') }}" class="btn btn-block btn-lg btn-primary">อาจารย์</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
