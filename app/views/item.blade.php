@extends('partials/layout')
@extends('partials/header')
@extends('partials/footer')
@extends('partials/left_sidebar')
@extends('partials/right_sidebar')

@section('meta')
	<title>Зип Общепит - {{ $item->title }}</title>
	<meta name='keywords' content='{{ $item->producer }} - {{ $item->title }} купить в Санкт-Петербурге'>
	<meta name='description' content='{{ $item->producer }} - {{ $item->title }}. {{ $item->description }}'>
@stop

@section('body')
	<div class="main_content">
		<ol class="breadcrumb">
		  <li><a href="/">Каталог</a></li>
		  <li>{{HTML::link($HELP::url_slug(["/", "category", "/", "$item->category"]), $HELP::getNormal($item->category)) }}</li>
			<li>{{HTML::link($HELP::url_slug(["/", "$item->category", "/", "$item->subcat"])."?subcat_id=$item->subcat_id", $item->subcat) }}</li>
		  <li class="active">{{$item->title}}</li>
		</ol>
		<!-- <hr class="main_hr"> -->
		<div class="item_page item_{{$item->item_id}}">
			<div class="item_page_heading">
				<h3 class="items_main_header universal_heading">{{$item->title}}</h3>
				<!-- <p class="item_page_name">{{$item->title}}</p> -->
				<p class="item_page_code">Артикул: {{$item->code}}</p>
				@if($item->price == 0.00)
					<div class="item_price_div">
						<p class="item_page_price up_letter">По запросу&nbsp</p>
						<p class="item_page_currency"></p>
					</div>
				@else	
					<div class="item_price_div">
						@if (Auth::user()->check())
							<p class="item_page_price">{{$HELP::discount_price($item->price)}}&nbsp</p>
						@else 
							<p class="item_page_price">{{$item->price}}&nbsp</p>
						@endif	
						<p class="item_page_currency">{{$item->currency}}.</p>
					</div>
				@endif	
			</div>
			<div class="item_page_descript">
				{{ HTML::image("img/photos/$item->photo", "$item->title", ['class'=>'items_item_img']) }}
				<table class="item_page_text">
					<tr>
						<td colspan='2'>Характеристики</td>
					</tr>
					<tr>
						<td>Бренд:&nbsp&nbsp&nbsp&nbsp</td>
						<td>{{$item->producer}}</td>
					</tr>
					<tr>
						<td>Код:</td>
						<td>{{$item->code}}</td>
					</tr>
					<tr>
						<td>Тип:&nbsp</td>
						<td>{{$item->subcat}}</td>
					</tr>
					<tr>
						<td>Наличие:&nbsp</td>
						@if ($item->procurement)
							<td>В наличии</td>
						@else	
							<td>Под заказ</td>
						@endif
					</tr>
				</table>
			</div>
			<div class="item_page_descr">
				<p class="item_page_descr_title">Описание:</p>
				<p class="item_page_descr_p">{{$item->description}}</p>
			</div>
			@if (Auth::user()->check())
				<a href="" class="item_order btn btn-default js_item_add" data-id="{{$item->item_id}}" data-price="{{HELP::discount_price($item->price)}}">В корзину</a>
			@else
				<a href="" class="item_order btn btn-default js_item_add" data-id="{{$item->item_id}}" data-price="{{$item->price}}">В корзину</a>
			@endif
			<a href="" class="item_order item_order--delete btn btn-default js_item_remove" data-id="{{$item->item_id}}">Отменить</a>
			<a href="/contacts#contact_sorm_ancher" class="item_more btn btn-default">Задать вопрос</a>
			<a href="/delivery" class="item_more item_more_delivery btn btn-default">Условия доставки</a>

			@include('partials/item_recommended')

		</div>
	</div>
@stop