@extends('partials/admin_layout')
@extends('partials/admin_header')
@extends('partials/admin_sidebar')
@extends('partials/admin_footer')

@section('body')
	@include('partials/flash_messages')
	<h1 class="admin_uni_heading">Подкатегории</h1>
	<div class="admin_one_cat_block admin_main_content">
		<div class="admin_catalog_category" data-category='Механическое_en'>
			<h4 class="admin_one_cat_heading">Механическое <br> оборудование (импортное)</h4>
			<a class="admin_one_cat_add" data-category='Механическое_en'><i class="fa fa-plus">&nbsp</i>Добавить подкатегорию</a>
			<div class="admin_add_subcategory_div mfp-hide mfp-zoom-out" data-effect="mfp-zoom-out">
				{{ Form::open(['url'=>'admin/update_subcat', 'method'=>'POST', 'class'=>'admin_add_subcategory_form input-group']) }}
					<p class="admin_add_subcategory_title">Добавить подкатегории</p>
					<div class="change_block admin_select_category_div">
						{{ Form::label('category', 'Категория', ['class'=>'admin_uni_label admin_select_category_label']) }}
						{{ Form::select('category', ['Механическое_en' => 'Механическое_en', 'Тепловое_en' => 'Тепловое_en','Холодильное_en' => 'Холодильное_en','Моечное_en' => 'Моечное_en','Механическое_ru' => 'Механическое_ru','Тепловое_ru' => 'Тепловое_ru','Холодильное_ru' => 'Холодильное_ru','Моечное_ru' => 'Моечное_ru'], 'Механическое_en', ['class'=>'form-control create_category', 'required']) }}
					</div>
					<div class="change_block admin_select_title_div">
						{{ Form::label('subcat', 'Название', ['class'=>'admin_uni_label admin_select_title_label']) }}
						{{ Form::text('subcat', null, ['class'=>'form-control admin_select_title_text', 'required']) }}
					</div>
					{{ Form::submit('Добавить', ['class'=>'btn admin_add_button admin_uni_button ']) }}
				{{ Form::close() }}
			</div> <!--admin_add_subcategory_div-->
			@if (count($subcats['Механическое_en']))
				<div class="admin_one_cat_subcats_block">
					<div class="admin_subcats_list">
						<div class="subcategory_left">
							<ul>
								@foreach ($HELP::columnize($subcats['Механическое_en'], 2, 1) as $key => $subcat)
									<li>
										<p class="admin_subcategory">
											{{ $subcat->subcat }}
										</p>
										<div class="subcats_btns">
											<a class="sub_btns_a"><i class="fa fa-pencil change_icon_{{$key}}" data-category='{{ $subcat->category }}'></i></a>
											{{ Form::open(array('url' => "/admin/delete_subcat?subcat_id=$subcat->subcat_id", 'method' => 'POST', 'class'=>'admin_subcategory_form')) }}
												<i class="fa fa-times delete_items_group_icon del_sc_ad"></i>
											{{ Form::close() }} 
										</div>
										<div class="admin_change_subcategory_div adm_ch_ca_{{$key}} mfp-hide mfp-zoom-out" data-effect="mfp-zoom-out">
											{{ Form::open(['url'=>"admin/update_subcat?subcat_id=$subcat->subcat_id", 'method'=>'POST', 'class'=>'admin_add_subcategory_form input-group']) }}
												<p class="admin_add_subcategory_title">Редактирование подкатегории</p>
												<div class="change_block admin_id_subcategory_div">
													<p class="admin_uni_label admin_id_subcategory_title">ID подкатегории</p>
													<p class="admin_id_subcategory_id">{{$subcat->subcat_id}}</p>
												</div>
												<div class="change_block admin_select_category_div">
													{{ Form::label('category', 'Категория', ['class'=>'admin_uni_label admin_select_category_label']) }}
													{{ Form::select('category', ['Механическое_en' => 'Механическое_en', 'Тепловое_en' => 'Тепловое_en','Холодильное_en' => 'Холодильное_en','Моечное_en' => 'Моечное_en','Механическое_ru' => 'Механическое_ru','Тепловое_ru' => 'Тепловое_ru','Холодильное_ru' => 'Холодильное_ru','Моечное_ru' => 'Моечное_ru'], $subcat->category, ['class'=>'form-control admin_select_category_select', 'required']) }}
							{{-- 						<select>
														<option selected disabled>Please Select</option>
														@foreach($authors as $author)
														<option value="{{ $author->id }}">{{ $author->name }}</option>
														@endforeach
													</select> --}}
												</div>
												<div class="change_block admin_select_title_div">
													{{ Form::label('subcat', 'Название', ['class'=>'admin_uni_label admin_select_title_label']) }}
													{{ Form::text('subcat', $subcat->subcat, ['class'=>'form-control admin_select_title_text', 'required']) }}
												</div>
												{{ Form::submit('Изменить', ['class'=>'btn admin_add_button admin_uni_button ']) }}
											{{ Form::close() }}
										</div> <!--admin_add_subcategory_div-->
										<script>
											// admin change subcategory
											$('.change_icon_{{$key}}').magnificPopup({
												items: {
													src: '.adm_ch_ca_{{$key}}', // CSS selector of an element on page that should be used as a popup
													type: 'inline'
												},
											});
										</script>
									</li>
								@endforeach
							</ul>
						</div>
						<div class="subcategory_right">
							<ul>	
								@foreach ($HELP::columnize($subcats['Механическое_en'], 2, 2) as $key => $subcat)
									<li>
										<p class="admin_subcategory">
											{{ $subcat->subcat }}
										</p>
										<div class="subcats_btns">
											<a class="sub_btns_a"><i class="fa fa-pencil change_icon_2_{{$key}}" data-category='{{ $subcat->category }}'></i></a>
											{{ Form::open(array('url' => "/admin/delete_subcat?subcat_id=$subcat->subcat_id", 'method' => 'POST', 'class'=>'admin_subcategory_form')) }}
												<i class="fa fa-times delete_items_group_icon del_sc_ad"></i>
											{{ Form::close() }} 
										</div>
										<div class="admin_change_subcategory_div adm_ch_ca_2_{{$key}} mfp-hide mfp-zoom-out" data-effect="mfp-zoom-out">
											{{ Form::open(['url'=>"admin/update_subcat?subcat_id=$subcat->subcat_id", 'method'=>'POST', 'class'=>'admin_add_subcategory_form input-group']) }}
												<p class="admin_add_subcategory_title">Редактирование подкатегории</p>
												<div class="change_block admin_id_subcategory_div">
													<p class="admin_uni_label admin_id_subcategory_title">ID подкатегории</p>
													<p class="admin_id_subcategory_id">{{$subcat->subcat_id}}</p>
												</div>
												<div class="change_block admin_select_category_div">
													{{ Form::label('category', 'Категория', ['class'=>'admin_uni_label admin_select_category_label']) }}
													{{ Form::select('category', ['Механическое_en' => 'Механическое_en', 'Тепловое_en' => 'Тепловое_en','Холодильное_en' => 'Холодильное_en','Моечное_en' => 'Моечное_en','Механическое_ru' => 'Механическое_ru','Тепловое_ru' => 'Тепловое_ru','Холодильное_ru' => 'Холодильное_ru','Моечное_ru' => 'Моечное_ru'], $subcat->category, ['class'=>'form-control admin_select_category_select', 'required']) }}
												</div>
												<div class="change_block admin_select_title_div">
													{{ Form::label('subcat', 'Название', ['class'=>'admin_uni_label admin_select_title_label']) }}
													{{ Form::text('subcat', $subcat->subcat, ['class'=>'form-control admin_select_title_text', 'required']) }}
												</div>
												{{ Form::submit('Изменить', ['class'=>'btn admin_add_button admin_uni_button ']) }}
											{{ Form::close() }}
										</div> <!--admin_add_subcategory_div-->
										<script>
											// admin change subcategory
											$('.change_icon_2_{{$key}}').magnificPopup({
												items: {
													src: '.adm_ch_ca_2_{{$key}}', // CSS selector of an element on page that should be used as a popup
													type: 'inline'
												},
											});
										</script>
									</li>
								@endforeach
							</ul>	
						</div>	
					</div><!-- admin_subcats_list -->
				</div><!--admin_one_cat_subcats_block-->
			@endif
		</div>	
		<div class="admin_catalog_category" data-category='Тепловое_en'>
			<h4 class="admin_one_cat_heading">Тепловое <br> оборудование (импортное)</h4>
			<a href="/admin/change_subcat" class="admin_one_cat_add" data-category="Тепловое_en"><i class="fa fa-plus">&nbsp</i>Добавить подкатегорию</a>
			@if (count($subcats['Тепловое_en']))
				<div class="admin_one_cat_subcats_block">
				<div class="admin_subcats_list">
					<div class="subcategory_left">
						<ul>
							@foreach ($HELP::columnize($subcats['Тепловое_en'], 2, 1) as $key => $subcat)
								<li>
									<p class="admin_subcategory">
										{{ $subcat->subcat }}
									</p>
									<div class="subcats_btns">
										<a class="sub_btns_a"><i class="fa fa-pencil change_icon_3_{{$key}}" data-category='{{ $subcat->category }}'></i></a>
										{{ Form::open(array('url' => "/admin/delete_subcat?subcat_id=$subcat->subcat_id", 'method' => 'POST', 'class'=>'admin_subcategory_form')) }}
											<i class="fa fa-times delete_items_group_icon del_sc_ad"></i>
										{{ Form::close() }} 
									</div>
									<div class="admin_change_subcategory_div adm_ch_ca_3_{{$key}} mfp-hide mfp-zoom-out" data-effect="mfp-zoom-out">
											{{ Form::open(['url'=>"admin/update_subcat?subcat_id=$subcat->subcat_id", 'method'=>'POST', 'class'=>'admin_add_subcategory_form input-group']) }}
												<p class="admin_add_subcategory_title">Редактирование подкатегории</p>
												<div class="change_block admin_id_subcategory_div">
													<p class="admin_uni_label admin_id_subcategory_title">ID подкатегории</p>
													<p class="admin_id_subcategory_id">{{$subcat->subcat_id}}</p>
												</div>
												<div class="change_block admin_select_category_div">
													{{ Form::label('category', 'Категория', ['class'=>'admin_uni_label admin_select_category_label']) }}
													{{ Form::select('category', ['Механическое_en' => 'Механическое_en', 'Тепловое_en' => 'Тепловое_en','Холодильное_en' => 'Холодильное_en','Моечное_en' => 'Моечное_en','Механическое_ru' => 'Механическое_ru','Тепловое_ru' => 'Тепловое_ru','Холодильное_ru' => 'Холодильное_ru','Моечное_ru' => 'Моечное_ru'], $subcat->category, ['class'=>'form-control admin_select_category_select', 'required']) }}
												</div>
												<div class="change_block admin_select_title_div">
													{{ Form::label('subcat', 'Название', ['class'=>'admin_uni_label admin_select_title_label']) }}
													{{ Form::text('subcat', $subcat->subcat, ['class'=>'form-control admin_select_title_text', 'required']) }}
												</div>
												{{ Form::submit('Изменить', ['class'=>'btn admin_add_button admin_uni_button ']) }}
											{{ Form::close() }}
										</div> <!--admin_add_subcategory_div-->
										<script>
											// admin change subcategory
											$('.change_icon_3_{{$key}}').magnificPopup({
												items: {
													src: '.adm_ch_ca_3_{{$key}}', // CSS selector of an element on page that should be used as a popup
													type: 'inline'
												},
											});
										</script>
								</li>
							@endforeach
						</ul>
					</div>
					<div class="subcategory_right">
						<ul>	
							@foreach ($HELP::columnize($subcats['Тепловое_en'], 2, 2)  as $key => $subcat)
								<li>
									<p class="admin_subcategory">
										{{ $subcat->subcat }}
									</p>
									<div class="subcats_btns">
										<a class="sub_btns_a"><i class="fa fa-pencil change_icon_4_{{$key}}" data-category='{{ $subcat->category }}'></i></a>
										{{ Form::open(array('url' => "/admin/delete_subcat?subcat_id=$subcat->subcat_id", 'method' => 'POST', 'class'=>'admin_subcategory_form')) }}
											<i class="fa fa-times delete_items_group_icon del_sc_ad"></i>
										{{ Form::close() }} 
									</div>
									<div class="admin_change_subcategory_div adm_ch_ca_4_{{$key}} mfp-hide mfp-zoom-out" data-effect="mfp-zoom-out">
											{{ Form::open(['url'=>"admin/update_subcat?subcat_id=$subcat->subcat_id", 'method'=>'POST', 'class'=>'admin_add_subcategory_form input-group']) }}
												<p class="admin_add_subcategory_title">Редактирование подкатегории</p>
												<div class="change_block admin_id_subcategory_div">
													<p class="admin_uni_label admin_id_subcategory_title">ID подкатегории</p>
													<p class="admin_id_subcategory_id">{{$subcat->subcat_id}}</p>
												</div>
												<div class="change_block admin_select_category_div">
													{{ Form::label('category', 'Категория', ['class'=>'admin_uni_label admin_select_category_label']) }}
													{{ Form::select('category', ['Механическое_en' => 'Механическое_en', 'Тепловое_en' => 'Тепловое_en','Холодильное_en' => 'Холодильное_en','Моечное_en' => 'Моечное_en','Механическое_ru' => 'Механическое_ru','Тепловое_ru' => 'Тепловое_ru','Холодильное_ru' => 'Холодильное_ru','Моечное_ru' => 'Моечное_ru'], $subcat->category, ['class'=>'form-control admin_select_category_select', 'required']) }}
												</div>
												<div class="change_block admin_select_title_div">
													{{ Form::label('subcat', 'Название', ['class'=>'admin_uni_label admin_select_title_label']) }}
													{{ Form::text('subcat', $subcat->subcat, ['class'=>'form-control admin_select_title_text', 'required']) }}
												</div>
												{{ Form::submit('Изменить', ['class'=>'btn admin_add_button admin_uni_button ']) }}
											{{ Form::close() }}
										</div> <!--admin_add_subcategory_div-->
										<script>
											// admin change subcategory
											$('.change_icon_4_{{$key}}').magnificPopup({
												items: {
													src: '.adm_ch_ca_4_{{$key}}', // CSS selector of an element on page that should be used as a popup
													type: 'inline'
												},
											});
										</script>
								</li>
							@endforeach
						</ul>	
					</div>
				</div><!-- admin_subcats_list -->		
				</div><!--admin_one_cat_subcats_block-->
			@endif
		</div>
		<div class="admin_catalog_category" data-category='Холодильное_en'>
			<h4 class="admin_one_cat_heading">Холодильное <br> оборудование (импортное)</h4>
			<a href="/admin/change_subcat" class="admin_one_cat_add" data-category="Холодильное_en"><i class="fa fa-plus">&nbsp</i>Добавить подкатегорию</a>
			@if (count($subcats['Холодильное_en']))
				<div class="admin_one_cat_subcats_block">
				<div class="admin_subcats_list">
					<div class="subcategory_left">
							<ul>
								@foreach ($HELP::columnize($subcats['Холодильное_en'], 2, 1) as $key => $subcat)
									<li>
										<p class="admin_subcategory">
											{{ $subcat->subcat }}
										</p>
										<div class="subcats_btns">
											<a class="sub_btns_a"><i class="fa fa-pencil change_icon_5_{{$key}}" data-category='{{ $subcat->category }}'></i></a>
											{{ Form::open(array('url' => "/admin/delete_subcat?subcat_id=$subcat->subcat_id", 'method' => 'POST', 'class'=>'admin_subcategory_form')) }}
												<i class="fa fa-times delete_items_group_icon del_sc_ad"></i>
											{{ Form::close() }} 
										</div>
										<div class="admin_change_subcategory_div adm_ch_ca_5_{{$key}} mfp-hide mfp-zoom-out" data-effect="mfp-zoom-out">
											{{ Form::open(['url'=>"admin/update_subcat?subcat_id=$subcat->subcat_id", 'method'=>'POST', 'class'=>'admin_add_subcategory_form input-group']) }}
												<p class="admin_add_subcategory_title">Редактирование подкатегории</p>
												<div class="change_block admin_id_subcategory_div">
													<p class="admin_uni_label admin_id_subcategory_title">ID подкатегории</p>
													<p class="admin_id_subcategory_id">{{$subcat->subcat_id}}</p>
												</div>
												<div class="change_block admin_select_category_div">
													{{ Form::label('category', 'Категория', ['class'=>'admin_uni_label admin_select_category_label']) }}
													{{ Form::select('category', ['Механическое_en' => 'Механическое_en', 'Тепловое_en' => 'Тепловое_en','Холодильное_en' => 'Холодильное_en','Моечное_en' => 'Моечное_en','Механическое_ru' => 'Механическое_ru','Тепловое_ru' => 'Тепловое_ru','Холодильное_ru' => 'Холодильное_ru','Моечное_ru' => 'Моечное_ru'], $subcat->category, ['class'=>'form-control admin_select_category_select', 'required']) }}
												</div>
												<div class="change_block admin_select_title_div">
													{{ Form::label('subcat', 'Название', ['class'=>'admin_uni_label admin_select_title_label']) }}
													{{ Form::text('subcat', $subcat->subcat, ['class'=>'form-control admin_select_title_text', 'required']) }}
												</div>
												{{ Form::submit('Изменить', ['class'=>'btn admin_add_button admin_uni_button ']) }}
											{{ Form::close() }}
										</div> <!--admin_add_subcategory_div-->
										<script>
											// admin change subcategory
											$('.change_icon_5_{{$key}}').magnificPopup({
												items: {
													src: '.adm_ch_ca_5_{{$key}}', // CSS selector of an element on page that should be used as a popup
													type: 'inline'
												},
											});
										</script>
									</li>
								@endforeach
							</ul>
					</div>
					<div class="subcategory_right">
							<ul>	
								@foreach ($HELP::columnize($subcats['Холодильное_en'], 2, 2) as $key => $subcat)
									<li>
										<p class="admin_subcategory">
											{{ $subcat->subcat }}
										</p>
										<div class="subcats_btns">
											<a class="sub_btns_a"><i class="fa fa-pencil change_icon_6_{{$key}}" data-category='{{ $subcat->category }}'></i></a>
											{{ Form::open(array('url' => "/admin/delete_subcat?subcat_id=$subcat->subcat_id", 'method' => 'POST', 'class'=>'admin_subcategory_form')) }}
												<i class="fa fa-times delete_items_group_icon del_sc_ad"></i>
											{{ Form::close() }} 
										</div>
										<div class="admin_change_subcategory_div adm_ch_ca_6_{{$key}} mfp-hide mfp-zoom-out" data-effect="mfp-zoom-out">
											{{ Form::open(['url'=>"admin/update_subcat?subcat_id=$subcat->subcat_id", 'method'=>'POST', 'class'=>'admin_add_subcategory_form input-group']) }}
												<p class="admin_add_subcategory_title">Редактирование подкатегории</p>
												<div class="change_block admin_id_subcategory_div">
													<p class="admin_uni_label admin_id_subcategory_title">ID подкатегории</p>
													<p class="admin_id_subcategory_id">{{$subcat->subcat_id}}</p>
												</div>
												<div class="change_block admin_select_category_div">
													{{ Form::label('category', 'Категория', ['class'=>'admin_uni_label admin_select_category_label']) }}
													{{ Form::select('category', ['Механическое_en' => 'Механическое_en', 'Тепловое_en' => 'Тепловое_en','Холодильное_en' => 'Холодильное_en','Моечное_en' => 'Моечное_en','Механическое_ru' => 'Механическое_ru','Тепловое_ru' => 'Тепловое_ru','Холодильное_ru' => 'Холодильное_ru','Моечное_ru' => 'Моечное_ru'], $subcat->category, ['class'=>'form-control admin_select_category_select', 'required']) }}
												</div>
												<div class="change_block admin_select_title_div">
													{{ Form::label('subcat', 'Название', ['class'=>'admin_uni_label admin_select_title_label']) }}
													{{ Form::text('subcat', $subcat->subcat, ['class'=>'form-control admin_select_title_text', 'required']) }}
												</div>
												{{ Form::submit('Изменить', ['class'=>'btn admin_add_button admin_uni_button ']) }}
											{{ Form::close() }}
										</div> <!--admin_add_subcategory_div-->
										<script>
											// admin change subcategory
											$('.change_icon_6_{{$key}}').magnificPopup({
												items: {
													src: '.adm_ch_ca_6_{{$key}}', // CSS selector of an element on page that should be used as a popup
													type: 'inline'
												},
											});
										</script>
									</li>
								@endforeach
							</ul>	
					</div>	
				</div><!-- admin_subcats_list -->	
				</div><!--admin_one_cat_subcats_block-->
			@endif
		</div>
		<div class="admin_catalog_category posud_catedory" data-category='Моечное_en'>
			<h4 class="admin_one_cat_heading">Моечное <br> оборудование (импортное)</h4>
			<a href="/admin/change_subcat" class="admin_one_cat_add" data-category="Моечное_en"><i class="fa fa-plus">&nbsp</i>Добавить подкатегорию</a>
			@if (count($subcats['Моечное_en']))
				<div class="admin_one_cat_subcats_block">
				<div class="admin_subcats_list">
					<div class="subcategory_left">
							<ul>
								@foreach ($HELP::columnize($subcats['Моечное_en'], 2, 1)as $key =>  $subcat)
									<li>
										<p class="admin_subcategory">
											{{ $subcat->subcat }}
										</p>
										<div class="subcats_btns">
											<a class="sub_btns_a"><i class="fa fa-pencil change_icon_7_{{$key}}" data-category='{{ $subcat->category }}'></i></a>
											{{ Form::open(array('url' => "/admin/delete_subcat?subcat_id=$subcat->subcat_id", 'method' => 'POST', 'class'=>'admin_subcategory_form')) }}
												<i class="fa fa-times delete_items_group_icon del_sc_ad"></i>
											{{ Form::close() }} 
										</div>
										<div class="admin_change_subcategory_div adm_ch_ca_7_{{$key}} mfp-hide mfp-zoom-out" data-effect="mfp-zoom-out">
											{{ Form::open(['url'=>"admin/update_subcat?subcat_id=$subcat->subcat_id", 'method'=>'POST', 'class'=>'admin_add_subcategory_form input-group']) }}
												<p class="admin_add_subcategory_title">Редактирование подкатегории</p>
												<div class="change_block admin_id_subcategory_div">
													<p class="admin_uni_label admin_id_subcategory_title">ID подкатегории</p>
													<p class="admin_id_subcategory_id">{{$subcat->subcat_id}}</p>
												</div>
												<div class="change_block admin_select_category_div">
													{{ Form::label('category', 'Категория', ['class'=>'admin_uni_label admin_select_category_label']) }}
													{{ Form::select('category', ['Механическое_en' => 'Механическое_en', 'Тепловое_en' => 'Тепловое_en','Холодильное_en' => 'Холодильное_en','Моечное_en' => 'Моечное_en','Механическое_ru' => 'Механическое_ru','Тепловое_ru' => 'Тепловое_ru','Холодильное_ru' => 'Холодильное_ru','Моечное_ru' => 'Моечное_ru'], $subcat->category, ['class'=>'form-control admin_select_category_select', 'required']) }}
												</div>
												<div class="change_block admin_select_title_div">
													{{ Form::label('subcat', 'Название', ['class'=>'admin_uni_label admin_select_title_label']) }}
													{{ Form::text('subcat', $subcat->subcat, ['class'=>'form-control admin_select_title_text', 'required']) }}
												</div>
												{{ Form::submit('Изменить', ['class'=>'btn admin_add_button admin_uni_button ']) }}
											{{ Form::close() }}
										</div> <!--admin_add_subcategory_div-->
										<script>
											// admin change subcategory
											$('.change_icon_7_{{$key}}').magnificPopup({
												items: {
													src: '.adm_ch_ca_7_{{$key}}', // CSS selector of an element on page that should be used as a popup
													type: 'inline'
												},
											});
										</script>
									</li>
								@endforeach
							</ul>
					</div>
					<div class="subcategory_right">
							<ul>	
								@foreach ($HELP::columnize($subcats['Моечное_en'], 2, 2) as $key => $subcat)
									<li>
										<p class="admin_subcategory">
											{{ $subcat->subcat }}
										</p>
										<div class="subcats_btns">
											<a class="sub_btns_a"><i class="fa fa-pencil change_icon_8_{{$key}}" data-category='{{ $subcat->category }}'></i></a>
											{{ Form::open(array('url' => "/admin/delete_subcat?subcat_id=$subcat->subcat_id", 'method' => 'POST', 'class'=>'admin_subcategory_form')) }}
												<i class="fa fa-times delete_items_group_icon del_sc_ad"></i>
											{{ Form::close() }} 
										</div>
										<div class="admin_change_subcategory_div adm_ch_ca_8_{{$key}} mfp-hide mfp-zoom-out" data-effect="mfp-zoom-out">
											{{ Form::open(['url'=>"admin/update_subcat?subcat_id=$subcat->subcat_id", 'method'=>'POST', 'class'=>'admin_add_subcategory_form input-group']) }}
												<p class="admin_add_subcategory_title">Редактирование подкатегории</p>
												<div class="change_block admin_id_subcategory_div">
													<p class="admin_uni_label admin_id_subcategory_title">ID подкатегории</p>
													<p class="admin_id_subcategory_id">{{$subcat->subcat_id}}</p>
												</div>
												<div class="change_block admin_select_category_div">
													{{ Form::label('category', 'Категория', ['class'=>'admin_uni_label admin_select_category_label']) }}
													{{ Form::select('category', ['Механическое_en' => 'Механическое_en', 'Тепловое_en' => 'Тепловое_en','Холодильное_en' => 'Холодильное_en','Моечное_en' => 'Моечное_en','Механическое_ru' => 'Механическое_ru','Тепловое_ru' => 'Тепловое_ru','Холодильное_ru' => 'Холодильное_ru','Моечное_ru' => 'Моечное_ru'], $subcat->category, ['class'=>'form-control admin_select_category_select', 'required']) }}
												</div>
												<div class="change_block admin_select_title_div">
													{{ Form::label('subcat', 'Название', ['class'=>'admin_uni_label admin_select_title_label']) }}
													{{ Form::text('subcat', $subcat->subcat, ['class'=>'form-control admin_select_title_text', 'required']) }}
												</div>
												{{ Form::submit('Изменить', ['class'=>'btn admin_add_button admin_uni_button ']) }}
											{{ Form::close() }}
										</div> <!--admin_add_subcategory_div-->
										<script>
											// admin change subcategory
											$('.change_icon_8_{{$key}}').magnificPopup({
												items: {
													src: '.adm_ch_ca_8_{{$key}}', // CSS selector of an element on page that should be used as a popup
													type: 'inline'
												},
											});
										</script>
									</li>
								@endforeach
							</ul>	
					</div>	
				</div><!-- admin_subcats_list -->
				</div><!--admin_one_cat_subcats_block-->
			@endif	
		</div>
		<div class="admin_catalog_category" data-category='Механическое_ru'>
			<h4 class="admin_one_cat_heading">Механическое <br> оборудование (российское)</h4>
			<a href="/admin/change_subcat" class="admin_one_cat_add" data-category="Механическое_ru"><i class="fa fa-plus">&nbsp</i>Добавить подкатегорию</a>
			@if (count($subcats['Механическое_ru']))
				<div class="admin_one_cat_subcats_block">
					<div class="admin_subcats_list">
						<div class="subcategory_left">
								<ul>
									@foreach ($HELP::columnize($subcats['Механическое_ru'], 2, 1)  as $key => $subcat)
										<li>
											<p class="admin_subcategory">
												{{ $subcat->subcat }}
											</p>
											<div class="subcats_btns">
												<a class="sub_btns_a"><i class="fa fa-pencil change_icon_9_{{$key}}" data-category='{{ $subcat->category }}'></i></a>
												{{ Form::open(array('url' => "/admin/delete_subcat?subcat_id=$subcat->subcat_id", 'method' => 'POST', 'class'=>'admin_subcategory_form')) }}
													<i class="fa fa-times delete_items_group_icon del_sc_ad"></i>
												{{ Form::close() }} 
											</div>
											<div class="admin_change_subcategory_div adm_ch_ca_9_{{$key}} mfp-hide mfp-zoom-out" data-effect="mfp-zoom-out">
											{{ Form::open(['url'=>"admin/update_subcat?subcat_id=$subcat->subcat_id", 'method'=>'POST', 'class'=>'admin_add_subcategory_form input-group']) }}
												<p class="admin_add_subcategory_title">Редактирование подкатегории</p>
												<div class="change_block admin_id_subcategory_div">
													<p class="admin_uni_label admin_id_subcategory_title">ID подкатегории</p>
													<p class="admin_id_subcategory_id">{{$subcat->subcat_id}}</p>
												</div>
												<div class="change_block admin_select_category_div">
													{{ Form::label('category', 'Категория', ['class'=>'admin_uni_label admin_select_category_label']) }}
													{{ Form::select('category', ['Механическое_en' => 'Механическое_en', 'Тепловое_en' => 'Тепловое_en','Холодильное_en' => 'Холодильное_en','Моечное_en' => 'Моечное_en','Механическое_ru' => 'Механическое_ru','Тепловое_ru' => 'Тепловое_ru','Холодильное_ru' => 'Холодильное_ru','Моечное_ru' => 'Моечное_ru'], $subcat->category, ['class'=>'form-control admin_select_category_select', 'required']) }}
												</div>
												<div class="change_block admin_select_title_div">
													{{ Form::label('subcat', 'Название', ['class'=>'admin_uni_label admin_select_title_label']) }}
													{{ Form::text('subcat', $subcat->subcat, ['class'=>'form-control admin_select_title_text', 'required']) }}
												</div>
												{{ Form::submit('Изменить', ['class'=>'btn admin_add_button admin_uni_button ']) }}
											{{ Form::close() }}
										</div> <!--admin_add_subcategory_div-->
										<script>
											// admin change subcategory
											$('.change_icon_9_{{$key}}').magnificPopup({
												items: {
													src: '.adm_ch_ca_9_{{$key}}', // CSS selector of an element on page that should be used as a popup
													type: 'inline'
												},
											});
										</script>
										</li>
									@endforeach
								</ul>
						</div>
						<div class="subcategory_right">
								<ul>	
									@foreach ($HELP::columnize($subcats['Механическое_ru'], 2, 2) as $key => $subcat)
										<li>
											<p class="admin_subcategory">
												{{ $subcat->subcat }}
											</p>
											<div class="subcats_btns">
												<a class="sub_btns_a"><i class="fa fa-pencil change_icon_10_{{$key}}" data-category='{{ $subcat->category }}'></i></a>
												{{ Form::open(array('url' => "/admin/delete_subcat?subcat_id=$subcat->subcat_id", 'method' => 'POST', 'class'=>'admin_subcategory_form')) }}
													<i class="fa fa-times delete_items_group_icon del_sc_ad"></i>
												{{ Form::close() }} 
											</div>
											<div class="admin_change_subcategory_div adm_ch_ca_10_{{$key}} mfp-hide mfp-zoom-out" data-effect="mfp-zoom-out">
											{{ Form::open(['url'=>"admin/update_subcat?subcat_id=$subcat->subcat_id", 'method'=>'POST', 'class'=>'admin_add_subcategory_form input-group']) }}
												<p class="admin_add_subcategory_title">Редактирование подкатегории</p>
												<div class="change_block admin_id_subcategory_div">
													<p class="admin_uni_label admin_id_subcategory_title">ID подкатегории</p>
													<p class="admin_id_subcategory_id">{{$subcat->subcat_id}}</p>
												</div>
												<div class="change_block admin_select_category_div">
													{{ Form::label('category', 'Категория', ['class'=>'admin_uni_label admin_select_category_label']) }}
													{{ Form::select('category', ['Механическое_en' => 'Механическое_en', 'Тепловое_en' => 'Тепловое_en','Холодильное_en' => 'Холодильное_en','Моечное_en' => 'Моечное_en','Механическое_ru' => 'Механическое_ru','Тепловое_ru' => 'Тепловое_ru','Холодильное_ru' => 'Холодильное_ru','Моечное_ru' => 'Моечное_ru'], $subcat->category, ['class'=>'form-control admin_select_category_select', 'required']) }}
												</div>
												<div class="change_block admin_select_title_div">
													{{ Form::label('subcat', 'Название', ['class'=>'admin_uni_label admin_select_title_label']) }}
													{{ Form::text('subcat', $subcat->subcat, ['class'=>'form-control admin_select_title_text', 'required']) }}
												</div>
												{{ Form::submit('Изменить', ['class'=>'btn admin_add_button admin_uni_button ']) }}
											{{ Form::close() }}
										</div> <!--admin_add_subcategory_div-->
										<script>
											// admin change subcategory
											$('.change_icon_10_{{$key}}').magnificPopup({
												items: {
													src: '.adm_ch_ca_10_{{$key}}', // CSS selector of an element on page that should be used as a popup
													type: 'inline'
												},
											});
										</script>
										</li>
									@endforeach
								</ul>	
						</div>
					</div><!-- admin_subcats_list -->	
				</div><!--admin_one_cat_subcats_block-->
			@endif	
		</div>
		<div class="admin_catalog_category" data-category='Тепловое_ru'>
			<h4 class="admin_one_cat_heading">Тепловое <br> оборудование (российское)</h4>
			<a href="/admin/change_subcat" class="admin_one_cat_add" data-category="Тепловое_ru"><i class="fa fa-plus">&nbsp</i>Добавить подкатегорию</a>
			@if (count($subcats['Тепловое_ru']))
				<div class="admin_one_cat_subcats_block">
				<div class="admin_subcats_list">
					<div class="subcategory_left">
							<ul>
								@foreach ($HELP::columnize($subcats['Тепловое_ru'], 2, 1) as $key => $subcat)
									<li>
										<p class="admin_subcategory">
											{{ $subcat->subcat }}
										</p>
										<div class="subcats_btns">
											<a class="sub_btns_a"><i class="fa fa-pencil change_icon_11_{{$key}}" data-category='{{ $subcat->category }}'></i></a>
											{{ Form::open(array('url' => "/admin/delete_subcat?subcat_id=$subcat->subcat_id", 'method' => 'POST', 'class'=>'admin_subcategory_form')) }}
												<i class="fa fa-times delete_items_group_icon del_sc_ad"></i>
											{{ Form::close() }} 
										</div>
										<div class="admin_change_subcategory_div adm_ch_ca_11_{{$key}} mfp-hide mfp-zoom-out" data-effect="mfp-zoom-out">
											{{ Form::open(['url'=>"admin/update_subcat?subcat_id=$subcat->subcat_id", 'method'=>'POST', 'class'=>'admin_add_subcategory_form input-group']) }}
												<p class="admin_add_subcategory_title">Редактирование подкатегории</p>
												<div class="change_block admin_id_subcategory_div">
													<p class="admin_uni_label admin_id_subcategory_title">ID подкатегории</p>
													<p class="admin_id_subcategory_id">{{$subcat->subcat_id}}</p>
												</div>
												<div class="change_block admin_select_category_div">
													{{ Form::label('category', 'Категория', ['class'=>'admin_uni_label admin_select_category_label']) }}
													{{ Form::select('category', ['Механическое_en' => 'Механическое_en', 'Тепловое_en' => 'Тепловое_en','Холодильное_en' => 'Холодильное_en','Моечное_en' => 'Моечное_en','Механическое_ru' => 'Механическое_ru','Тепловое_ru' => 'Тепловое_ru','Холодильное_ru' => 'Холодильное_ru','Моечное_ru' => 'Моечное_ru'], $subcat->category, ['class'=>'form-control admin_select_category_select', 'required']) }}
												</div>
												<div class="change_block admin_select_title_div">
													{{ Form::label('subcat', 'Название', ['class'=>'admin_uni_label admin_select_title_label']) }}
													{{ Form::text('subcat', $subcat->subcat, ['class'=>'form-control admin_select_title_text', 'required']) }}
												</div>
												{{ Form::submit('Изменить', ['class'=>'btn admin_add_button admin_uni_button ']) }}
											{{ Form::close() }}
										</div> <!--admin_add_subcategory_div-->
										<script>
											// admin change subcategory
											$('.change_icon_11_{{$key}}').magnificPopup({
												items: {
													src: '.adm_ch_ca_11_{{$key}}', // CSS selector of an element on page that should be used as a popup
													type: 'inline'
												},
											});
										</script>
									</li>
								@endforeach
							</ul>
					</div>
					<div class="subcategory_right">
						<ul>	
							@foreach ($HELP::columnize($subcats['Тепловое_ru'], 2, 2)  as $key => $subcat)
								<li>
									<p class="admin_subcategory">
										{{ $subcat->subcat }}
										{{-- <a><i class="fa fa-pencil change_icon_12_{{$key}}" data-category='{{ $subcat->category }}'></i></a>
										{{ Form::open(array('url' => "/admin/delete_subcat?subcat_id=$subcat->subcat_id", 'method' => 'POST', 'class'=>'admin_subcategory_form')) }}
											<i class="fa fa-times delete_items_group_icon del_sc_ad"></i>
										{{ Form::close() }}  --}}
									</p>
									<div class="subcats_btns">
										<a class="sub_btns_a"><i class="fa fa-pencil change_icon_12_{{$key}}" data-category='{{ $subcat->category }}'></i></a>
										{{ Form::open(array('url' => "/admin/delete_subcat?subcat_id=$subcat->subcat_id", 'method' => 'POST', 'class'=>'admin_subcategory_form')) }}
											<i class="fa fa-times delete_items_group_icon del_sc_ad"></i>
										{{ Form::close() }} 
									</div>
									<div class="admin_change_subcategory_div adm_ch_ca_12_{{$key}} mfp-hide mfp-zoom-out" data-effect="mfp-zoom-out">
											{{ Form::open(['url'=>"admin/update_subcat?subcat_id=$subcat->subcat_id", 'method'=>'POST', 'class'=>'admin_add_subcategory_form input-group']) }}
												<p class="admin_add_subcategory_title">Редактирование подкатегории</p>
												<div class="change_block admin_id_subcategory_div">
													<p class="admin_uni_label admin_id_subcategory_title">ID подкатегории</p>
													<p class="admin_id_subcategory_id">{{$subcat->subcat_id}}</p>
												</div>
												<div class="change_block admin_select_category_div">
													{{ Form::label('category', 'Категория', ['class'=>'admin_uni_label admin_select_category_label']) }}
													{{ Form::select('category', ['Механическое_en' => 'Механическое_en', 'Тепловое_en' => 'Тепловое_en','Холодильное_en' => 'Холодильное_en','Моечное_en' => 'Моечное_en','Механическое_ru' => 'Механическое_ru','Тепловое_ru' => 'Тепловое_ru','Холодильное_ru' => 'Холодильное_ru','Моечное_ru' => 'Моечное_ru'], $subcat->category, ['class'=>'form-control admin_select_category_select', 'required']) }}
												</div>
												<div class="change_block admin_select_title_div">
													{{ Form::label('subcat', 'Название', ['class'=>'admin_uni_label admin_select_title_label']) }}
													{{ Form::text('subcat', $subcat->subcat, ['class'=>'form-control admin_select_title_text', 'required']) }}
												</div>
												{{ Form::submit('Изменить', ['class'=>'btn admin_add_button admin_uni_button ']) }}
											{{ Form::close() }}
										</div> <!--admin_add_subcategory_div-->
										<script>
											// admin change subcategory
											$('.change_icon_12_{{$key}}').magnificPopup({
												items: {
													src: '.adm_ch_ca_12_{{$key}}', // CSS selector of an element on page that should be used as a popup
													type: 'inline'
												},
											});
										</script>
								</li>
							@endforeach
						</ul>	
					</div>	
				</div><!-- admin_subcats_list -->
				</div><!--admin_one_cat_subcats_block-->
			@endif	
		</div>
		<div class="admin_catalog_category" data-category='Холодильное_ru'>
			<h4 class="admin_one_cat_heading">Холодильное <br> оборудование (российское)</h4>
			<a href="/admin/change_subcat" class="admin_one_cat_add" data-category="Холодильное_ru"><i class="fa fa-plus">&nbsp</i>Добавить подкатегорию</a>
			@if (count($subcats['Холодильное_ru']))
				<div class="admin_one_cat_subcats_block">
				<div class="admin_subcats_list">
					<div class="subcategory_left">
							<ul>
								@foreach ($HELP::columnize($subcats['Холодильное_ru'], 2, 1) as $key =>  $subcat)
									<li>
										<p class="admin_subcategory">
											{{ $subcat->subcat }}
										</p>
										<div class="subcats_btns">
											<a class="sub_btns_a"><i class="fa fa-pencil change_icon_13_{{$key}}" data-category='{{ $subcat->category }}'></i></a>
											{{ Form::open(array('url' => "/admin/delete_subcat?subcat_id=$subcat->subcat_id", 'method' => 'POST', 'class'=>'admin_subcategory_form')) }}
												<i class="fa fa-times delete_items_group_icon del_sc_ad"></i>
											{{ Form::close() }} 
										</div>
										<div class="admin_change_subcategory_div adm_ch_ca_13_{{$key}} mfp-hide mfp-zoom-out" data-effect="mfp-zoom-out">
											{{ Form::open(['url'=>"admin/update_subcat?subcat_id=$subcat->subcat_id", 'method'=>'POST', 'class'=>'admin_add_subcategory_form input-group']) }}
												<p class="admin_add_subcategory_title">Редактирование подкатегории</p>
												<div class="change_block admin_id_subcategory_div">
													<p class="admin_uni_label admin_id_subcategory_title">ID подкатегории</p>
													<p class="admin_id_subcategory_id">{{$subcat->subcat_id}}</p>
												</div>
												<div class="change_block admin_select_category_div">
													{{ Form::label('category', 'Категория', ['class'=>'admin_uni_label admin_select_category_label']) }}
													{{ Form::select('category', ['Механическое_en' => 'Механическое_en', 'Тепловое_en' => 'Тепловое_en','Холодильное_en' => 'Холодильное_en','Моечное_en' => 'Моечное_en','Механическое_ru' => 'Механическое_ru','Тепловое_ru' => 'Тепловое_ru','Холодильное_ru' => 'Холодильное_ru','Моечное_ru' => 'Моечное_ru'], $subcat->category, ['class'=>'form-control admin_select_category_select', 'required']) }}
												</div>
												<div class="change_block admin_select_title_div">
													{{ Form::label('subcat', 'Название', ['class'=>'admin_uni_label admin_select_title_label']) }}
													{{ Form::text('subcat', $subcat->subcat, ['class'=>'form-control admin_select_title_text', 'required']) }}
												</div>
												{{ Form::submit('Изменить', ['class'=>'btn admin_add_button admin_uni_button ']) }}
											{{ Form::close() }}
										</div> <!--admin_add_subcategory_div-->
										<script>
											// admin change subcategory
											$('.change_icon_13_{{$key}}').magnificPopup({
												items: {
													src: '.adm_ch_ca_13_{{$key}}', // CSS selector of an element on page that should be used as a popup
													type: 'inline'
												},
											});
										</script>
									</li>
								@endforeach
							</ul>
					</div>
					<div class="subcategory_right">
						<ul>	
							@foreach ($HELP::columnize($subcats['Холодильное_ru'], 2, 2) as $key => $subcat)
								<li>
									<p class="admin_subcategory">
										{{ $subcat->subcat }}
									</p>
									<div class="subcats_btns">
										<a class="sub_btns_a"><i class="fa fa-pencil change_icon_14_{{$key}}" data-category='{{ $subcat->category }}'></i></a>
										{{ Form::open(array('url' => "/admin/delete_subcat?subcat_id=$subcat->subcat_id", 'method' => 'POST', 'class'=>'admin_subcategory_form')) }}
											<i class="fa fa-times delete_items_group_icon del_sc_ad"></i>
										{{ Form::close() }} 
									</div>
									<div class="admin_change_subcategory_div adm_ch_ca_14_{{$key}} mfp-hide mfp-zoom-out" data-effect="mfp-zoom-out">
											{{ Form::open(['url'=>"admin/update_subcat?subcat_id=$subcat->subcat_id", 'method'=>'POST', 'class'=>'admin_add_subcategory_form input-group']) }}
												<p class="admin_add_subcategory_title">Редактирование подкатегории</p>
												<div class="change_block admin_id_subcategory_div">
													<p class="admin_uni_label admin_id_subcategory_title">ID подкатегории</p>
													<p class="admin_id_subcategory_id">{{$subcat->subcat_id}}</p>
												</div>
												<div class="change_block admin_select_category_div">
													{{ Form::label('category', 'Категория', ['class'=>'admin_uni_label admin_select_category_label']) }}
													{{ Form::select('category', ['Механическое_en' => 'Механическое_en', 'Тепловое_en' => 'Тепловое_en','Холодильное_en' => 'Холодильное_en','Моечное_en' => 'Моечное_en','Механическое_ru' => 'Механическое_ru','Тепловое_ru' => 'Тепловое_ru','Холодильное_ru' => 'Холодильное_ru','Моечное_ru' => 'Моечное_ru'], $subcat->category, ['class'=>'form-control admin_select_category_select', 'required']) }}
												</div>
												<div class="change_block admin_select_title_div">
													{{ Form::label('subcat', 'Название', ['class'=>'admin_uni_label admin_select_title_label']) }}
													{{ Form::text('subcat', $subcat->subcat, ['class'=>'form-control admin_select_title_text', 'required']) }}
												</div>
												{{ Form::submit('Изменить', ['class'=>'btn admin_add_button admin_uni_button ']) }}
											{{ Form::close() }}
										</div> <!--admin_add_subcategory_div-->
										<script>
											// admin change subcategory
											$('.change_icon_14_{{$key}}').magnificPopup({
												items: {
													src: '.adm_ch_ca_14_{{$key}}', // CSS selector of an element on page that should be used as a popup
													type: 'inline'
												},
											});
										</script>
								</li>
							@endforeach
						</ul>	
					</div>
				</div><!-- admin_subcats_list -->	
				</div><!--admin_one_cat_subcats_block-->
			@endif	
		</div>
		<div class="admin_catalog_category posud_catedory" data-category='Моечное_ru'>
			<h4 class="admin_one_cat_heading">Моечное <br> оборудование (российское)</h4>
			<a href="/admin/change_subcat" class="admin_one_cat_add" data-category="Моечное_ru"><i class="fa fa-plus">&nbsp</i>Добавить подкатегорию</a>
			@if (count($subcats['Моечное_ru']))
				<div class="admin_one_cat_subcats_block">
				<div class="admin_subcats_list">
					<div class="subcategory_left">
						<ul>
							@foreach ($HELP::columnize($subcats['Моечное_ru'], 2, 1) as $key => $subcat)
								<li>
									<p class="admin_subcategory">
										{{ $subcat->subcat }}
									</p>
									<div class="subcats_btns">
										<a class="sub_btns_a"><i class="fa fa-pencil change_icon_15_{{$key}}" data-category='{{ $subcat->category }}'></i></a>
										{{ Form::open(array('url' => "/admin/delete_subcat?subcat_id=$subcat->subcat_id", 'method' => 'POST', 'class'=>'admin_subcategory_form')) }}
											<i class="fa fa-times delete_items_group_icon del_sc_ad"></i>
										{{ Form::close() }} 
									</div>
									<div class="admin_change_subcategory_div adm_ch_ca_15_{{$key}} mfp-hide mfp-zoom-out" data-effect="mfp-zoom-out">
											{{ Form::open(['url'=>"admin/update_subcat?subcat_id=$subcat->subcat_id", 'method'=>'POST', 'class'=>'admin_add_subcategory_form input-group']) }}
												<p class="admin_add_subcategory_title">Редактирование подкатегории</p>
												<div class="change_block admin_id_subcategory_div">
													<p class="admin_uni_label admin_id_subcategory_title">ID подкатегории</p>
													<p class="admin_id_subcategory_id">{{$subcat->subcat_id}}</p>
												</div>
												<div class="change_block admin_select_category_div">
													{{ Form::label('category', 'Категория', ['class'=>'admin_uni_label admin_select_category_label']) }}
													{{ Form::select('category', ['Механическое_en' => 'Механическое_en', 'Тепловое_en' => 'Тепловое_en','Холодильное_en' => 'Холодильное_en','Моечное_en' => 'Моечное_en','Механическое_ru' => 'Механическое_ru','Тепловое_ru' => 'Тепловое_ru','Холодильное_ru' => 'Холодильное_ru','Моечное_ru' => 'Моечное_ru'], $subcat->category, ['class'=>'form-control admin_select_category_select', 'required']) }}
												</div>
												<div class="change_block admin_select_title_div">
													{{ Form::label('subcat', 'Название', ['class'=>'admin_uni_label admin_select_title_label']) }}
													{{ Form::text('subcat', $subcat->subcat, ['class'=>'form-control admin_select_title_text', 'required']) }}
												</div>
												{{ Form::submit('Изменить', ['class'=>'btn admin_add_button admin_uni_button ']) }}
											{{ Form::close() }}
										</div> <!--admin_add_subcategory_div-->
										<script>
											// admin change subcategory
											$('.change_icon_15_{{$key}}').magnificPopup({
												items: {
													src: '.adm_ch_ca_15_{{$key}}', // CSS selector of an element on page that should be used as a popup
													type: 'inline'
												},
											});
										</script>
								</li>
							@endforeach
						</ul>
					</div>
					<div class="subcategory_right">
						<ul>	
							@foreach ($HELP::columnize($subcats['Моечное_ru'], 2, 2) as $key =>  $subcat)
								<li>
									<p class="admin_subcategory">
										{{ $subcat->subcat }}
									</p>
									<div class="subcats_btns">
										<a class="sub_btns_a"><i class="fa fa-pencil change_icon_16_{{$key}}" data-category='{{ $subcat->category }}'></i></a>
										{{ Form::open(array('url' => "/admin/delete_subcat?subcat_id=$subcat->subcat_id", 'method' => 'POST', 'class'=>'admin_subcategory_form')) }}
											<i class="fa fa-times delete_items_group_icon del_sc_ad"></i>
										{{ Form::close() }} 
									</div>
									<div class="admin_change_subcategory_div adm_ch_ca_16_{{$key}} mfp-hide mfp-zoom-out" data-effect="mfp-zoom-out">
											{{ Form::open(['url'=>"admin/update_subcat?subcat_id=$subcat->subcat_id", 'method'=>'POST', 'class'=>'admin_add_subcategory_form input-group']) }}
												<p class="admin_add_subcategory_title">Редактирование подкатегории</p>
												<div class="change_block admin_id_subcategory_div">
													<p class="admin_uni_label admin_id_subcategory_title">ID подкатегории</p>
													<p class="admin_id_subcategory_id">{{$subcat->subcat_id}}</p>
												</div>
												<div class="change_block admin_select_category_div">
													{{ Form::label('category', 'Категория', ['class'=>'admin_uni_label admin_select_category_label']) }}
													{{ Form::select('category', ['Механическое_en' => 'Механическое_en', 'Тепловое_en' => 'Тепловое_en','Холодильное_en' => 'Холодильное_en','Моечное_en' => 'Моечное_en','Механическое_ru' => 'Механическое_ru','Тепловое_ru' => 'Тепловое_ru','Холодильное_ru' => 'Холодильное_ru','Моечное_ru' => 'Моечное_ru'], $subcat->category, ['class'=>'form-control admin_select_category_select', 'required']) }}
												</div>
												<div class="change_block admin_select_title_div">
													{{ Form::label('subcat', 'Название', ['class'=>'admin_uni_label admin_select_title_label']) }}
													{{ Form::text('subcat', $subcat->subcat, ['class'=>'form-control admin_select_title_text', 'required']) }}
												</div>
												{{ Form::submit('Изменить', ['class'=>'btn admin_add_button admin_uni_button ']) }}
											{{ Form::close() }}
										</div> <!--admin_add_subcategory_div-->
										<script>
											// admin change subcategory
											$('.change_icon_16_{{$key}}').magnificPopup({
												items: {
													src: '.adm_ch_ca_16_{{$key}}', // CSS selector of an element on page that should be used as a popup
													type: 'inline'
												},
											});
										</script>
								</li>
							@endforeach
						</ul>	
					</div>
				</div><!-- admin_subcats_list -->
				</div><!--admin_one_cat_subcats_block-->
			@endif	
		</div>
	</div>
@stop
