@extends('partials/layout')
@extends('partials/header')
@extends('partials/footer')
@extends('partials/left_sidebar')
@extends('partials/right_sidebar')
@include('partials/initial_meta')

@section('body')
	<div class="main_content">
		<ol class="breadcrumb">
		  <li><a href="/">Каталог</a></li>
		  <li class="active">{{ $HELP::getNormal($HELP::$translit[Request::segment(2)]) }} оборудование</li>
		</ol>
		<h2 class="one_category_heading universal_heading">{{ $HELP::getNormal($HELP::$translit[Request::segment(2)]) }} оборудование</h2>
		<hr class="main_hr">
			<ul class="subcats">
			@foreach ($subcats as $subcat)
				<li class="subcat">
					{{ HTML::link($HELP::url_slug(["/", "$subcat->category", "/", "$subcat->subcat"])."?subcat_id=$subcat->subcat_id", $subcat->subcat) }}
				</li>
			@endforeach
			</ul>
	</div>
@stop