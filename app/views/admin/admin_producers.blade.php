@extends('partials/admin_layout')
@extends('partials/admin_header')
@extends('partials/admin_sidebar')
@extends('partials/admin_footer')

@section('body')
	@include('partials/flash_messages')
	<h1 class="admin_uni_heading">Производители</h1>
	<div class="admin_main_content">
		<a class="admin_producer_add mfp-zoom-out" data-effect="mfp-zoom-out"><i class="fa fa-plus">&nbsp</i>Добавить производителя</a>
			<div class="admin_add_subcategory_div adm_add_pr_div mfp-hide mfp-zoom-out" data-effect="mfp-zoom-out">
				{{ Form::open(['url'=>'admin/update_producer', 'method'=>'POST', 'class'=>'admin_add_subcategory_form input-group']) }}
					<p class="admin_add_subcategory_title">Добавить производителя</p>
					<div class="change_block admin_select_title_div">
						{{ Form::label('producer', 'Название', ['class'=>'admin_uni_label admin_select_title_label']) }}
						{{ Form::text('producer', null, ['class'=>'form-control admin_select_title_text', 'required']) }}
					</div>
					<div class="change_article_img">
						<input id="fileupload" name='ajax_photo' type="file" class="browse_img_admin" data-url="ajax_item_image" multiple form='none'>
						<a id="trigger_link_img" class="btn admin_uni_button">Выбрать миниатюру</a>
					</div>

					<div class="img_preview">
						@if (isset($producer->photo) && $producer->photo != 'no_photo.png')
							<img src='{{ URL::to("img/photos/")}}/{{ $producer->photo }}' class='items_item_img' data-filepath='{{ $HELP::$ITEM_PHOTO_DIR.DIRECTORY_SEPARATOR.'producers'.DIRECTORY_SEPARATOR.$producer->photo }}'>
							<i class="fa fa-times delete_img_icon_ajax"></i>
							{{ Form::hidden('old', $producer->photo) }}
							{{ Form::hidden('photo', $producer->photo, ['class' => 'inserted_input']) }}
						@else
							{{ Form::hidden('old', 'no_photo.png') }}
							{{ Form::hidden('photo', 'no_photo.png', ['class' => 'inserted_input']) }}
							<img src='{{ URL::to("img/photos")}}/{{ "no_photo.png" }}' class='items_item_img' >
						@endif
						{{-- 	@if (Session::get('temp_article'))
								<img src='{{ URL::to("img/photos/")}}/{{ Session::get("temp_article") }}' class='items_item_img'>
								<i class="fa fa-times delete_img_icon"></i>
							@else
								{{ HTML::image("img/photos/no_photo.png", "", ['class'=>'items_item_img']) }}
							@endif --}}
					</div>
					{{ Form::submit('Добавить', ['class'=>'btn admin_add_button admin_uni_button ']) }}
				{{ Form::close() }}
			</div> <!--admin_add_subcategory_div-->
		<div class = "groups admin_producers_groups">
			<ul class="producers_list producers_first">
				@foreach ($HELP::columnize($producers, 3, 1) as $key => $producer)
					<li>
						<div class="admin_producer_one">
							{{ Form::open(array('url' => "/admin/delete_producer?producer_id=$producer->producer_id", 'method' => 'POST', 'class'=>'admin_producer_one_form')) }}
								<i class="fa fa-times delete_items_group_icon delete_pr_icon"></i>
							{{ Form::close() }}
							<a><i class="fa fa-pencil change_icon_pr_{{$key}}"></i></a>
							<p>{{$producer->producer}}</p> 
						</div>
						<div class="admin_change_subcategory_div adm_ch_pd_div_{{$key}} mfp-hide mfp-zoom-out" data-effect="mfp-zoom-out" data-smth="di">
							{{ Form::open(['url'=>"/admin/update_producer?producer_id=$producer->producer_id", 'method'=>'POST', 'class'=>'admin_add_subcategory_form input-group']) }}
								<p class="admin_add_subcategory_title">Редактировать производителя</p>
								<div class="change_block admin_id_subcategory_div">
									<p class="admin_uni_label admin_id_subcategory_title">ID производителя</p>
									<p class="admin_id_subcategory_id">{{$producer->producer_id}}</p>
								</div>
								<div class="change_block admin_select_title_div">
									{{ Form::label('producer', 'Название', ['class'=>'admin_uni_label admin_select_title_label']) }}
									{{ Form::text('producer', $producer->producer, ['class'=>'form-control admin_select_title_text', 'required']) }}
								</div>
								<div class="change_article_img">
									<input id="fileupload" name='ajax_photo' type="file" class="browse_img_admin" data-url="ajax_item_image" multiple form='none'>
									<a id="trigger_link_img" class="btn admin_uni_button add_img">Выбрать миниатюру</a>
								</div>
								<div class="img_preview">
									@if (isset($producer->photo) && $producer->photo != 'no_photo.png')
										<img src='{{ URL::to("img/photos/")}}/{{ $producer->photo }}' class='items_item_img' data-filepath='{{ $HELP::$ITEM_PHOTO_DIR.DIRECTORY_SEPARATOR.'producers'.DIRECTORY_SEPARATOR.$producer->photo }}'>
										<i class="fa fa-times delete_img_icon_ajax"></i>
										{{ Form::hidden('old', $producer->photo) }}
										{{ Form::hidden('photo', $producer->photo, ['class' => 'inserted_input']) }}
									@else
										{{ Form::hidden('old', 'no_photo.png') }}
										{{ Form::hidden('photo', 'no_photo.png', ['class' => 'inserted_input']) }}
										<img src='{{ URL::to("img/photos")}}/{{ "no_photo.png" }}' class='items_item_img' >
									@endif
								</div>
								{{ Form::submit('Изменить', ['class'=>'btn admin_add_button admin_uni_button ']) }}
							{{ Form::close() }}
						</div> <!--admin_add_subcategory_div-->
						<script>
							// admin change producer
							$('.change_icon_pr_{{$key}}').magnificPopup({
								items: {
									src: '.adm_ch_pd_div_{{$key}}', // CSS selector of an element on page that should be used as a popup
									type: 'inline'
								},
							});
						</script>
					</li>
				@endforeach
			</ul>
			<ul class="producers_list producers_second">
				@foreach ($HELP::columnize($producers, 3, 2) as $key => $producer)
					<li>
						<div class="admin_producer_one">
							{{ Form::open(array('url' => "/admin/delete_producer?producer_id=$producer->producer_id", 'method' => 'POST', 'class'=>'admin_producer_one_form')) }}
								<i class="fa fa-times delete_items_group_icon delete_pr_icon"></i>
							{{ Form::close() }}
							<a><i class="fa fa-pencil change_icon_pr_2_{{$key}}"></i></a>
							<p>{{$producer->producer}}</p> 
						</div>
						<div class="admin_change_subcategory_div adm_ch_pd_div_2_{{$key}} mfp-hide mfp-zoom-out" data-effect="mfp-zoom-out" data-smth="di">
							{{ Form::open(['url'=>"/admin/update_producer?producer_id=$producer->producer_id", 'method'=>'POST', 'class'=>'admin_add_subcategory_form input-group']) }}
								<p class="admin_add_subcategory_title">Редактировать производителя</p>
								<div class="change_block admin_id_subcategory_div">
									<p class="admin_uni_label admin_id_subcategory_title">ID производителя</p>
									<p class="admin_id_subcategory_id">{{$producer->producer_id}}</p>
								</div>
								<div class="change_block admin_select_title_div">
									{{ Form::label('producer', 'Название', ['class'=>'admin_uni_label admin_select_title_label']) }}
									{{ Form::text('producer', $producer->producer, ['class'=>'form-control admin_select_title_text', 'required']) }}
								</div>
							<div class="change_article_img">
								<input id="fileupload" name='ajax_photo' type="file" class="browse_img_admin" data-url="ajax_item_image" multiple form='none'>
								<a id="trigger_link_img" class="btn admin_uni_button add_img">Выбрать миниатюру</a>
							</div>
							<div class="img_preview">
								@if (isset($producer->photo) && $producer->photo != 'no_photo.png')
									<img src='{{ URL::to("img/photos/")}}/{{ $producer->photo }}' class='items_item_img' data-filepath='{{ $HELP::$ITEM_PHOTO_DIR.DIRECTORY_SEPARATOR.'producers'.DIRECTORY_SEPARATOR.$producer->photo }}'>
									<i class="fa fa-times delete_img_icon_ajax"></i>
									{{ Form::hidden('old', $producer->photo) }}
									{{ Form::hidden('photo', $producer->photo, ['class' => 'inserted_input']) }}
								@else
									{{ Form::hidden('old', 'no_photo.png') }}
									{{ Form::hidden('photo', 'no_photo.png', ['class' => 'inserted_input']) }}
									<img src='{{ URL::to("img/photos")}}/{{ "no_photo.png" }}' class='items_item_img' >
								@endif
							</div>
								{{ Form::submit('Добавить', ['class'=>'btn admin_add_button admin_uni_button ']) }}
							{{ Form::close() }}
						</div> <!--admin_add_subcategory_div-->
						<script>
							// admin change producer
							$('.change_icon_pr_2_{{$key}}').magnificPopup({
								items: {
									src: '.adm_ch_pd_div_2_{{$key}}', // CSS selector of an element on page that should be used as a popup
									type: 'inline'
								},
							});
						</script>
					</li>	
				@endforeach
			</ul>	
			<ul class="producers_list producers_third">
				@foreach ($HELP::columnize($producers, 3, 3) as $key => $producer)
					<li>
						<div class="admin_producer_one">
							{{ Form::open(array('url' => "/admin/delete_producer?producer_id=$producer->producer_id", 'method' => 'POST', 'class'=>'admin_producer_one_form')) }}
								<i class="fa fa-times delete_items_group_icon delete_pr_icon"></i>
							{{ Form::close() }}
							<a><i class="fa fa-pencil change_icon_pr_3_{{$key}}"></i></a>
							<p>{{$producer->producer}}</p> 
						</div>
						<div class="admin_change_subcategory_div adm_ch_pd_div_3_{{$key}} mfp-hide mfp-zoom-out" data-effect="mfp-zoom-out" data-smth="di">
							{{ Form::open(['url'=>"/admin/update_producer?producer_id=$producer->producer_id", 'method'=>'POST', 'class'=>'admin_add_subcategory_form input-group']) }}
								<p class="admin_add_subcategory_title">Редактировать производителя</p>
								<div class="change_block admin_id_subcategory_div">
									<p class="admin_uni_label admin_id_subcategory_title">ID производителя</p>
									<p class="admin_id_subcategory_id">{{$producer->producer_id}}</p>
								</div>
								<div class="change_block admin_select_title_div">
									{{ Form::label('producer', 'Название', ['class'=>'admin_uni_label admin_select_title_label']) }}
									{{ Form::text('producer', $producer->producer, ['class'=>'form-control admin_select_title_text', 'required']) }}
								</div>
							<div class="change_article_img">
								<input id="fileupload" name='ajax_photo' type="file" class="browse_img_admin" data-url="ajax_item_image" multiple form='none'>
								<a id="trigger_link_img" class="btn admin_uni_button add_img">Выбрать миниатюру</a>
							</div>
							<div class="img_preview">
								@if (isset($producer->photo) && $producer->photo != 'no_photo.png')
									<img src='{{ URL::to("img/photos/")}}/{{ $producer->photo }}' class='items_item_img' data-filepath='{{ $HELP::$ITEM_PHOTO_DIR.DIRECTORY_SEPARATOR.'producers'.DIRECTORY_SEPARATOR.$producer->photo }}'>
									<i class="fa fa-times delete_img_icon_ajax"></i>
									{{ Form::hidden('old', $producer->photo) }}
									{{ Form::hidden('photo', $producer->photo, ['class' => 'inserted_input']) }}
								@else
									{{ Form::hidden('old', 'no_photo.png') }}
									{{ Form::hidden('photo', 'no_photo.png', ['class' => 'inserted_input']) }}
									<img src='{{ URL::to("img/photos")}}/{{ "no_photo.png" }}' class='items_item_img' >
								@endif
							</div>
								{{ Form::submit('Добавить', ['class'=>'btn admin_add_button admin_uni_button ']) }}
							{{ Form::close() }}
						</div> <!--admin_add_subcategory_div-->
						<script>
							// admin change producer
							$('.change_icon_pr_3_{{$key}}').magnificPopup({
								items: {
									src: '.adm_ch_pd_div_3_{{$key}}', // CSS selector of an element on page that should be used as a popup
									type: 'inline'
								},
							});
						</script>
					</li>	
				@endforeach
			</ul>
			{{-- <ul class="producers_list producers_fourth">
				@foreach ($HELP::columnize($producers, 4, 4) as $key => $producer)
					<li>
						<p class="admin_producer_one">
							<a><i class="fa fa-pencil change_icon_pr_4_{{$key}}"></i></a>
							{{$producer->producer}} 
							{{ Form::open(array('url' => "/admin/delete_producer?producer_id=$producer->producer_id", 'method' => 'POST', 'class'=>'admin_producer_one_form')) }}
								<i class="fa fa-times delete_items_group_icon delete_pr_icon"></i>
							{{ Form::close() }}
						</p>
						<div class="admin_change_subcategory_div adm_ch_pd_div_4_{{$key}} mfp-hide mfp-zoom-out" data-effect="mfp-zoom-out" data-smth="di">
							{{ Form::open(['url'=>"/admin/update_producer?producer_id=$producer->producer_id", 'method'=>'POST', 'class'=>'admin_add_subcategory_form input-group']) }}
								<p class="admin_add_subcategory_title">Редактировать производителя</p>
								<div class="change_block admin_id_subcategory_div">
									<p class="admin_uni_label admin_id_subcategory_title">ID производителя</p>
									<p class="admin_id_subcategory_id">{{$producer->producer_id}}</p>
								</div>
								<div class="change_block admin_select_title_div">
									{{ Form::label('producer', 'Название', ['class'=>'admin_uni_label admin_select_title_label']) }}
									{{ Form::text('producer', $producer->producer, ['class'=>'form-control admin_select_title_text', 'required']) }}
								</div>
								{{ Form::submit('Добавить', ['class'=>'btn admin_add_button admin_uni_button ']) }}
							{{ Form::close() }}
						</div> <!--admin_add_subcategory_div-->
						<script>
							// admin change producer
							$('.change_icon_pr_4_{{$key}}').magnificPopup({
								items: {
									src: '.adm_ch_pd_div_4_{{$key}}', // CSS selector of an element on page that should be used as a popup
									type: 'inline'
								},
							});
						</script>
					</li>	
				@endforeach
			</ul> --}}
		</div> <!-- groups  -->
		<a class="btn admin_uni_button">Сохранить</a>
	</div>
@stop
