@extends('layouts.app')

@section('link')
    @parent
@stop

@section('content')
    <div class="container">
    	<h1>ระบบการบริหารงานกิจการนักศึกษา</h1>
    	<div class="row">
    		<div class="col-md-3">
    			<div class="panel panel-default">
    				<div class="panel-heading">
    					<h3 class="panel-title">ระบบสมาชิก</h3>
    				</div>
    				<div class="panel-body">
    					@if (count($errors) > 0)
    						<div class="alert alert-danger">
    							<strong>{{ $errors->first() }}</strong>
    						</div>
                        @endif

    					@if( Auth::guest() )
	    					<form role="form" method="POST" action="{{ url('/login') }}">
		    					{!! csrf_field() !!}

	    						<div class="form-group">
	    							<input type="text" class="form-control" name="sdu_id" id="input-id" placeholder="รหัสบุคลากร" value="{{ old('sdu_id') }}">
	    						</div>
	    						<div class="form-group">
	    							<input type="password" class="form-control" name="password" id="input-password" placeholder="รหัสผ่าน">
	    						</div>
	    						<div class="checkbox">
	    							<label><input type="checkbox" name="remember"> จดจำบัญชี</label>
	    						</div>
	    						<div class="form-group">
	    							<button type="submit" class="btn btn-block btn-primary">เข้าสู่ระบบ</button>
	    						</div>
	    					</form>
	    					<div class="text-center">
	    						<a href="{{ url('register') }}">สมัครสมาชิก</a>
                                <a class="btn btn-link" href="{{ url('/password/reset') }}">ลืมรหัสผ่าน</a>
	    					</div>
    					@else
    						<div class="text-center">
                                <div class="m-b-15">
                                    <img src="{{ asset(Auth::user()->avatar) }}" class="img-responsive" style="display: inline-block; width:100px;">
                                </div>
                                <div>
                                    {{ Auth::user()->firstname }}
                                    {{ Auth::user()->lastname }}
                                </div>
                                @if (Auth::user()->type == 'student')
                                    <div>ตอนเรียน {{ strtoupper(Auth::user()->section) }}</div>
                                @endif
    						</div>
    					@endif
    				</div>
    			</div>

                @if( Auth::check() )
                <div class="list-group">
                    <a href="{{ url('activities') }}" class="list-group-item">กิจกรรมทั้งหมด</a>
                    @if (Auth::user()->type == 'student')
                        <a href="{{ url('activities/join') }}" class="list-group-item">กิจกรรมที่เข้าร่วม</a>
                    @endif
                    <a href="{{ url('logout') }}" class="list-group-item">ออกจากระบบ</a>
                </div>
                @endif

    			<div class="panel panel-default hide">
    				<div class="panel-heading">
    					<h3 class="panel-title">ปฏิทิน</h3>
    				</div>
    				<div class="panel-body">
    					
    				</div>
    			</div>
    		</div>
            <div class="col-md-9">

                <div class="panel panel-default hide">
                    <div class="panel-heading">
                        <h3 class="panel-title">ข่าวสาร</h3>
                    </div>
                    @foreach(App\Activities::take(10)->orderBy('updated_at', 'desc')->get() as $value)
                    <div class="panel-body">
                        <div class="item">
                            <a href="{{ url('activities/'.$value->id) }}">
                                {{ $value->name }}
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                @yield('content-panel')

            </div>
    	</div>
    </div>
@stop