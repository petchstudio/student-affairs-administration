@extends('layouts.front-office')

@section('link')
    @parent
@stop

@section('content-panel')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">กิจกรรม</h3>
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
@stop