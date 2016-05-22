@extends('layouts.basic-template')

@section('link')
    @parent
    <link href="{{ asset('assets/css/welcome.css') }}" rel="stylesheet">
@stop

@section('container')
    <div id="carousel-top" class="carousel slide m-b-30" data-ride="carousel">
	  <!-- Indicators -->
	  <ol class="carousel-indicators">
	    <li data-target="#carousel-top" data-slide-to="0" class="active"></li>
	    <li data-target="#carousel-top" data-slide-to="1"></li>
	    <li data-target="#carousel-top" data-slide-to="2"></li>
	  </ol>

	  <!-- Wrapper for slides -->
	  <div class="carousel-inner" role="listbox">
	    <div class="item active">
	      <img src="{{ asset('assets/images/slide/01.jpg') }}">
	    </div>
	    <div class="item">
	      <img src="{{ asset('assets/images/slide/02.jpg') }}">
	    </div>
	    <div class="item">
	      <img src="{{ asset('assets/images/slide/03.jpg') }}">
	    </div>
	  </div>

	  <!-- Controls -->
	  <a class="left carousel-control" href="#carousel-top" role="button" data-slide="prev">
	    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
	    <span class="sr-only">Previous</span>
	  </a>
	  <a class="right carousel-control" href="#carousel-top" role="button" data-slide="next">
	    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	    <span class="sr-only">Next</span>
	  </a>
	</div>
	@yield('content')
@stop