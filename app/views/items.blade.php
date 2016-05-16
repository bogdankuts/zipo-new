@extends('partials/layout')
@extends('partials/header')
@extends('partials/footer')
@extends('partials/left_sidebar')
@extends('partials/right_sidebar')
@if ('specials' != $env && 'search' != $env)
	@section('meta')
		<title>Запчасти подкатегории: {{$current->subcat}}</title>
		<meta name='keywords' content='Запчасти подкатегории: {{$current->subcat}} - Зип Общепит'>
		<meta name='description' content='Запчасти подкатегории: {{$current->subcat}} - Зип Общепит'>
	@stop
@endif

@section('body')
	<div class="main_content">

		@include('partials/items_breadcrumbs')

		<hr class="main_hr">

		@include('partials/items_sorting')

		@foreach ($items as $item)
			<div class="empty_scape item_{{$item->item_id}}">
				@if ($item->hit&&$item->special)
				{{ HTML::image("img/markup/hit_prodag.png", "хит продаж", ['class'=>'items_item_flag']) }}
				{{ HTML::image("img/markup/spec_flag.png", "спецпредложение", ['class'=>'items_item_flag_d']) }}
				@elseif ($item->hit)
					{{ HTML::image("img/markup/hit_prodag.png", "хит продаж", ['class'=>'items_item_flag']) }}
				@elseif ($item->special)
					{{ HTML::image("img/markup/spec_flag.png", "спецпредложение", ['class'=>'items_item_flag']) }}
				@endif	
				<div class="@if ($item->hit) item_hit @elseif ($item->special) item_spec @endif items_item_one">
					<div class="items_item_text_block">	
						<div class="items_item_heading">
							<div class="name_and_code">
								<div class="items_item_name_div">
									{{HTML::link($HELP::url_slug(["/", "$item->category", "/", "$item->subcat", "/", "$item->title"])."?subcat_id=$item->subcat_id&item_id=$item->item_id", $item->title,['class'=>'items_item_name']) }}
									{{HTML::link($HELP::url_slug(["/", "$item->category", "/", "$item->subcat", "/", "$item->title"])."?subcat_id=$item->subcat_id&item_id=$item->item_id", $item->title,['class'=>'items_item_name_full']) }}
								</div>	
							</div>	
							<div class="items_item_code_div">
								<p class="items_item_code">Арт: {{$item->code}}</p>
								<p class="items_item_code_full">Арт: {{$item->code}}</p>
							</div>	
							@if($item->price == 0.00)
								<div class="items_item_price_div">
										<p class="items_item_price">По запросу&nbsp</p>
										<p class="items_item_currency"></p>
								</div>
							@else	
								<div class="items_item_price_div">
									@if (Auth::user()->check())
										<p class="items_item_price">{{HELP::discount_price($item->price)}}&nbsp</p>
									@else 
										<p class="items_item_price">{{$item->price}}&nbsp</p>
									@endif
										<p class="items_item_currency">{{$item->currency}}.</p>
								</div>
							@endif
						</div>
						<div class="items_item_descript">
							{{ HTML::image("img/photos/$item->photo", "$item->title", ['class'=>'items_page_item_img']) }}
							<table class="items_item_text">
								<tr>
									<td colspan='2' class="small_heading">Характеристики</td>
								</tr>
								<tr>
									<td>Бренд:&nbsp&nbsp&nbsp&nbsp</td>
									<td class="items_item_dyn_text">{{$item->producer}}</td>
								</tr>
								<tr>
									<td>Код:</td>
									<td class="items_item_dyn_text">{{$item->code}}</td>
								</tr>
								<tr>
									<td>Тип:&nbsp</td>
									<td class="items_item_dyn_text">{{$item->subcat}}</td>
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
					</div>	
					<div class="items_buttons">
				 		{{HTML::link($HELP::url_slug(["/", "$item->category", "/", "$item->subcat", "/", "$item->title"])."?subcat_id=$item->subcat_id&item_id=$item->item_id", 'Подробнее',['class'=>'btn btn-default items_button items_more']) }}
						@if (Auth::user()->check())
							<a href="" class="btn btn-default items_button items_order js_item_add" data-id="{{$item->item_id}}" data-price="{{HELP::discount_price($item->price)}}">В корзину</a>
						@else
							<a href="" class="btn btn-default items_button items_order js_item_add" data-id="{{$item->item_id}}" data-price="{{$item->price}}">В корзину</a>
						@endif
						<a href="" class="btn btn-default items_button items_order items_order--delete js_item_remove" data-id="{{$item->item_id}}">Отменить</a>
					</div>
				</div>
			</div>	
		@endforeach

		@include('partials/items_pagination')

	</div>	
@stop

@section('js')
	<?php	
		parse_str(Request::getQueryString(), $params);    
		$isset = isset($params["pages_by"]);
		if (false==$isset) {
			echo <<< 'HERE'
				var pages_by = localStorage["pages_by"] = 10;
				var $options = $("#pages_by option");
				$options.each(function(index) {
					if ($(this).val() == pages_by) {
						$(this).attr("selected", "selected");
					} 
				});
HERE;
		}   
	?>   
@stop