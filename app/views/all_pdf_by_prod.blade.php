@extends('partials/layout')
@extends('partials/header')
@extends('partials/footer')
@extends('partials/left_sidebar')
@extends('partials/right_sidebar')
@section('meta')
	<title>Деталировки {{$producer->producer}}</title>
	<meta name='keywords' content='Деталировки {{$producer->producer}} - Зип Общепит'>
	<meta name='description' content='Деталировки {{$producer->producer}} - Зип Общепит'>
@stop

@section('body')
	<div class="main_content">
		<ol class="breadcrumb">
		  <li><a href="/">Каталог</a></li>
		  <li>{{HTML::link($HELP::url_slug(["/all_pdf"]), "Все деталировки") }}</li>
		  <li class="active">Деталировки {{$producer->producer}}</li>
		</ol>
		<h4 class="universal_heading">Деталировки производителя</h4>
		<hr class="main_hr">
		<div class="pdf_list">
			<ul> 
				@foreach ($pdfs as $pdf)
					<li>
						{{ HTML::link("/one_pdf?pdf_id=$pdf->pdf_id"."&producer_id=$pdf->producer_id", $pdf->good) }}
					</li>	
				@endforeach 
			</ul>
		</div>
	</div>	
@stop