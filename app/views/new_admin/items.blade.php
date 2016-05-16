@extends('new_admin/admin_layout')
@extends('new_admin/partials/header')
@extends('new_admin/partials/drawer')
@extends('new_admin/partials/footer')
@extends('new_admin/partials/modals-new_item_subcat')

@section('body')
	@include('partials/flash_messages')
	<div class="new_admins_list--items mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
		<div class="selected_quantity_fixed_main">
			<div class="selected_quantity_fixed" data-spy="affix" data-offset-top="84">
				<p class="selected_quantity">0 элементов</p>
			</div>
		</div>
		<h1 class="admin_uni_heading">Каталог</h1>
		<h2 class="admin_uni_heading head_right">
			@if ($env=='byproducer')
				{{$current->producer}}
			@elseif ($env == 'search')
				{{ $current }}
			@else
				{{$HELP::getNormal($current->category)}}
				@if (substr($current->category, -3) === "_en")
					(импортное)
				@else
					(российское)
				@endif
			@endif
		</h2>
		<div class="admin_main_content admin_main_content_items">
			@if ($env != 'catalog_admin' and $env!= 'byproducer' )
				<hr class="main_hr">
			@endif
			@include('partials/items_sorting')

			@foreach ($items as $item)
				<div class="empty_scape">
					@if ($item->hit&&$item->special)
						{{ HTML::image("img/markup/hit_prodag.png", "хит продаж", ['class'=>'items_item_flag']) }}
						{{ HTML::image("img/markup/spec_flag.png", "спецпредложение", ['class'=>'items_item_flag_d']) }}
					@elseif ($item->hit)
						{{ HTML::image("img/markup/hit_prodag.png", "хит продаж", ['class'=>'items_item_flag']) }}
					@elseif ($item->special)
						{{ HTML::image("img/markup/spec_flag.png", "спецпредложение", ['class'=>'items_item_flag']) }}
					@endif
					<div class="@if ($item->hit) item_hit @elseif ($item->special) item_spec @endif items_item_one admin_items"><!--last class is for admin css-->
						<div class="admin_items_buttons">
							<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect item_selected_checkbox" for="{{$item->item_id}}">
								{{ Form::checkbox('selcted', true, false, ['class'=>'mdl-checkbox__input', 'data-id'=>$item->item_id, 'id'=>$item->item_id]) }}
							</label>
							<!-- Right aligned menu below button -->
							<button id="{{$item->item_id}}-menu-trigger" class="mdl-button mdl-js-button mdl-button--icon admin_item_menu_trigger">
								<i class="material-icons">more_vert</i>
							</button>
							<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="{{$item->item_id}}-menu-trigger">
								<li class="mdl-menu__item">
									<a href='{{URL::to("admin/change_item?item_id=$item->item_id")}}' class="">
										Изменить
									</a>
								</li>
								{{ Form::open(array('url' => "/admin/delete_item?item_id=$item->item_id", 'method' => 'POST', 'class'=>'admin_producer_one_form')) }}
									<li class="mdl-menu__item delete_items_group_icon">
										Удалить
									</li>
								{{ Form::close() }}
							</ul>
						</div>
						<div class="items_item_text_block">
							<div class="items_item_heading">
								<div class="name_and_code">
									<div class="items_item_name_div">
										<p class="items_item_name">{{$item->title}}</p>
										<p class="items_item_name_full">{{$item->title}}</p>
									</div>
								</div>
								<div class="items_item_code_div">
									<p class="items_item_code">Арт: {{$item->code}}</p>
									<p class="items_item_code_full">Арт: {{$item->code}}</p>
								</div>
								@if ($item->price == 0.00)
									<div class="items_item_price_div">
										<p class="items_item_price">По запросу&nbsp</p>
										<p class="items_item_currency"></p>
									</div>
								@else
									<div class="items_item_price_div">
										<p class="items_item_price">{{$item->price}}&nbsp</p>
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
					</div>
				</div>
			@endforeach
		</div>
		<div class="admin_items_footer_main">
			<div class="admin_items_footer">
				<div class="change_items_buttons_first">
					<!-- Accent-colored raised button with ripple -->
					<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored ajax_change_state spec_btn_adm" data-url='/admin/ajax_set_special'>Добавить в спецпредложения</a>
					<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored ajax_change_state" data-url='/admin/ajax_set_hit'>Сделать хитом продаж</a>
					<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored ajax_change_state proc_btn_adm" data-url='/admin/ajax_set_procurement'>Изменить наличие</a>
				</div>
				<div class="change_items_buttons_second">
					<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored ad_it_ch_c mfp-zoom-out" data-effect="mfp-zoom-out" data-toggle="modal" data-target="#changeSubcat">Изменить категорию/подкатегорию</a>
					<a class="btn add_to_pdf mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored ad_pdf_p mfp-zoom-out" data-effect="mfp-zoom-out">Добавить/удалить ссылки к PDF</a>
					<div class="admin_change_subcategory_div admin_itms_pdf_div mfp-hide mfp-zoom-out" data-effect="mfp-zoom-out">
						<div class="ad_pdf_pop_up">
							<p class="admin_add_subcategory_title">Редактирование/добавление деталировки</p>
							<div class="change_block admin_select_category_div">
								{{ Form::label('pdf', 'PDF', ['class'=>'admin_uni_label admin_select_category_label']) }}
								{{ Form::select('pdf', $HELP::createOptions($pdfs, 'pdf_id', 'good'), null, ['class'=>'form-control admin_select_category_select admin_select_pdf', 'required', 'form' => 'none']) }}
							</div>
							<a class="change_item_pdf mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored aadb admin_uni_button ">Сохранить</a>
						</div>
					</div>
					<a class="btn delete_group_button mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">Удалить товары</a>
				</div>
			</div>
		</div>
	</div>

@stop