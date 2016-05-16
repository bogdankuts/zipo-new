@extends('partials/layout')
@extends('partials/header')
@extends('partials/footer')
@extends('partials/left_sidebar')
@extends('partials/right_sidebar')
@section('meta')
	<title>Деталлировки производителей</title>
	<meta name='keywords' content='Деталлировки производителей - Зип Общепит'>
	<meta name='description' content='Деталлировки производителей  - Зип Общепит'>
@stop

@section('body')
	<div class="main_content">
		<ol class="breadcrumb">
		  <li><a href="/">Каталог</a></li>
		  <li class="active">Все деталировки</li>
		</ol>
		<h4 class="universal_heading">Все деталировки по категориям</h4>
		<hr class="main_hr">
			<div class="catalog_categoies">
			<div class="catalog_foreing">
				<h4 class="foreign_heding">Импортное</h4>
				<div class="catalog_category" data-category='Механическое_en'>
					<img src="img/markup/kateg_mech.png" alt="" class="catalog_category_img">
					<p class="catalog_category_heading">Механическое<br> оборудование</p>
				</div>
				<div class="catalog_category" data-category='Тепловое_en'>
					<img src="img/markup/kateg_tepl.png" alt="" class="catalog_category_img">
					<p class="catalog_category_heading">Тепловое<br> оборудование</p>
				</div>
				<div class="subcategory_block sub_1" data-category='Механическое_en'>
					<div class="subcategory_column">
						<div class="subcategory_left">
							<ul>
								@foreach ($HELP::columnize($cats_producers['Механическое_en'], 2, 1) as $producer)
									<li>
										{{ HTML::link($HELP::url_slug(['/', 'all_pdf', '/', "$producer->producer"])."?category=Механическое_en&producer_id=$producer->producer_id", $producer->producer) }}
									</li>
								@endforeach
							</ul>
						</div>
						<div class="subcategory_right">
							<ul>	
								@foreach ($HELP::columnize($cats_producers['Механическое_en'], 2, 2) as $producer)
									<li>
										{{ HTML::link($HELP::url_slug(['/', 'all_pdf', '/', "$producer->producer"])."?category=Механическое_en&producer_id=$producer->producer_id", $producer->producer) }}
									</li>
								@endforeach
							</ul>	
						</div>	
					</div><!-- brands_column -->
				</div><!-- subcategory block -->
				<div class="subcategory_block" data-category='Тепловое_en'>
					<div class="subcategory_column">
						<div class="subcategory_left">
							<ul>
								@foreach ($HELP::columnize($cats_producers['Тепловое_en'], 2, 1) as $producer)
									<li>
										{{ HTML::link($HELP::url_slug(['/', 'all_pdf', '/', "$producer->producer"])."?category=Тепловое_en&producer_id=$producer->producer_id", $producer->producer) }}
									</li>
								@endforeach
							</ul>
						</div>	
						<div class="subcategory_right">
							<ul>	
								@foreach ($HELP::columnize($cats_producers['Тепловое_en'], 2, 2) as $producer)
									<li>
										{{ HTML::link($HELP::url_slug(['/', 'all_pdf', '/', "$producer->producer"])."?category=Тепловое_en&producer_id=$producer->producer_id", $producer->producer) }}
									</li>
								@endforeach
							</ul>	
						</div>
					</div><!-- brands_column -->
				</div><!-- subcategory block -->
				<div class="catalog_category" data-category='Холодильное_en'>
					<img src="img/markup/kateg_holod.png" alt="" class="catalog_category_img">
					<p class="catalog_category_heading">Холодильное<br> оборудование</p>
				</div>
				<div class="catalog_category posud_catedory" data-category='Моечное_en'>
					<img src="img/markup/kateg_posud.png" alt="" class="catalog_category_img">
					<p class="catalog_category_heading">Моечное<br> оборудование</p>
				</div>
				<div class="subcategory_block " data-category='Холодильное_en'>
					<div class="subcategory_column">
						<div class="subcategory_left">
							<ul>
								@foreach ($HELP::columnize($cats_producers['Холодильное_en'], 2, 1) as $producer)
									<li>
										{{ HTML::link($HELP::url_slug(['/', 'all_pdf', '/', "$producer->producer"])."?category=Холодильное_en&producer_id=$producer->producer_id", $producer->producer) }}
									</li>
								@endforeach
							</ul>
						</div>	
						<div class="subcategory_right">
							<ul>	
								@foreach ($HELP::columnize($cats_producers['Холодильное_en'], 2, 2) as $producer)
									<li>
										{{ HTML::link($HELP::url_slug(['/', 'all_pdf', '/', "$producer->producer"])."?category=Холодильное_en&producer_id=$producer->producer_id", $producer->producer) }}
									</li>
								@endforeach
							</ul>	
						</div>
					</div><!-- brands_column -->
				</div><!-- subcategory block -->
				<div class="subcategory_block " data-category='Моечное_en'>
					<div class="subcategory_column">
						<div class="subcategory_left">
							<ul>
								@foreach ($HELP::columnize($cats_producers['Моечное_en'], 2, 1) as $producer)
									<li>
										{{ HTML::link($HELP::url_slug(['/', 'all_pdf', '/', "$producer->producer"])."?category=Моечное_en&producer_id=$producer->producer_id", $producer->producer) }}
									</li>
								@endforeach
							</ul>
						</div>	
						<div class="subcategory_right">
							<ul>	
								@foreach ($HELP::columnize($cats_producers['Моечное_en'], 2, 2) as $producer)
									<li>
										{{ HTML::link($HELP::url_slug(['/', 'all_pdf', '/', "$producer->producer"])."?category=Моечное_en&producer_id=$producer->producer_id", $producer->producer) }}
									</li>
								@endforeach
							</ul>	
						</div>
					</div><!-- brands_column -->
				</div><!-- subcategory block -->
			</div>
			<div class="catalog_russian">
				<h4 class="russian_heding">Отечественное</h4>
				<div class="catalog_category" data-category='Механическое_ru'>
					<img src="img/markup/kateg_mech.png" alt="" class="catalog_category_img">
					<p class="catalog_category_heading">Механическое<br> оборудование</p>
				</div>
				<div class="catalog_category" data-category='Тепловое_ru'>
					<img src="img/markup/kateg_tepl.png" alt="" class="catalog_category_img">
					<p class="catalog_category_heading">Тепловое<br> оборудование</p>
				</div>
				<div class="subcategory_block" data-category='Механическое_ru'>
					<div class="subcategory_column">
						<div class="subcategory_left">
							<ul>
								@foreach ($HELP::columnize($cats_producers['Механическое_ru'], 2, 1) as $producer)
									<li>
										{{ HTML::link($HELP::url_slug(['/', 'all_pdf', '/', "$producer->producer"])."?category=Механическое_ru&producer_id=$producer->producer_id", $producer->producer) }}
									</li>
								@endforeach
							</ul>
						</div>
						<div class="subcategory_right">
							<ul>	
								@foreach ($HELP::columnize($cats_producers['Механическое_ru'], 2, 2) as $producer)
									<li>
										{{ HTML::link($HELP::url_slug(['/', 'all_pdf', '/', "$producer->producer"])."?category=Механическое_ru&producer_id=$producer->producer_id", $producer->producer) }}
									</li>
								@endforeach
							</ul>	
						</div>	
					</div><!-- brands_column -->
				</div><!-- subcategory block -->
				<div class="subcategory_block" data-category='Тепловое_ru'>
					<div class="subcategory_column">
						<div class="subcategory_left">
							<ul>
								@foreach ($HELP::columnize($cats_producers['Тепловое_ru'], 2, 1) as $producer)
									<li>
										{{ HTML::link($HELP::url_slug(['/', 'all_pdf', '/', "$producer->producer"])."?category=Тепловое_ru&producer_id=$producer->producer_id", $producer->producer) }}
									</li>
								@endforeach
							</ul>
						</div>	
						<div class="subcategory_right">
							<ul>	
								@foreach ($HELP::columnize($cats_producers['Тепловое_ru'], 2, 2) as $producer)
									<li>
										{{ HTML::link($HELP::url_slug(['/', 'all_pdf', '/', "$producer->producer"])."?category=Тепловое_ru&producer_id=$producer->producer_id", $producer->producer) }}
									</li>
								@endforeach
							</ul>	
						</div>
					</div><!-- brands_column -->
				</div><!-- subcategory block -->
				<div class="catalog_category" data-category='Холодильное_ru'>
					<img src="img/markup/kateg_holod.png" alt="" class="catalog_category_img">
					<p class="catalog_category_heading">Холодильное<br> оборудование</p>
				</div>
				<div class="catalog_category posud_catedory" data-category='Моечное_ru'>
					<img src="img/markup/kateg_posud.png" alt="" class="catalog_category_img">

					<p class="catalog_category_heading">Моечное<br> оборудование</p>
				</div>
				<div class="subcategory_block second_line" data-category='Холодильное_ru'>
					<div class="subcategory_column">
						<div class="subcategory_left">
							<ul>
								@foreach ($HELP::columnize($cats_producers['Холодильное_ru'], 2, 1) as $producer)
									<li>
										{{ HTML::link($HELP::url_slug(['/', 'all_pdf', '/', "$producer->producer"])."?category=Холодильное_ru&producer_id=$producer->producer_id", $producer->producer) }}
									</li>
								@endforeach
							</ul>
						</div>	
						<div class="subcategory_right">
							<ul>	
								@foreach ($HELP::columnize($cats_producers['Холодильное_ru'], 2, 2) as $producer)
									<li>
										{{ HTML::link($HELP::url_slug(['/', 'all_pdf', '/', "$producer->producer"])."?category=Холодильное_ru&producer_id=$producer->producer_id", $producer->producer) }}
									</li>
								@endforeach
							</ul>	
						</div>
					</div><!-- brands_column -->
				</div><!-- subcategory block -->
				<div class="subcategory_block second_line" data-category='Моечное_ru'>
					<div class="subcategory_column">
						<div class="subcategory_left">
							<ul>
								@foreach ($HELP::columnize($cats_producers['Моечное_ru'], 2, 1) as $producer)
									<li>
										{{ HTML::link($HELP::url_slug(['/', 'all_pdf', '/', "$producer->producer"])."?category=Моечное_ru&producer_id=$producer->producer_id", $producer->producer) }}
									</li>
								@endforeach
							</ul>
						</div>	
						<div class="subcategory_right">
							<ul>	
								@foreach ($HELP::columnize($cats_producers['Моечное_ru'], 2, 2) as $producer)
									<li>
										{{ HTML::link($HELP::url_slug(['/', 'all_pdf', '/', "$producer->producer"])."?category=Моечное_ru&producer_id=$producer->producer_id", $producer->producer) }}
									</li>
								@endforeach
							</ul>	
						</div>
					</div><!-- brands_column -->
				</div><!-- subcategory block -->
			</div><!--catalog_russian-->	
		</div>
		{{-- <div class="pdf_all_list">
			<ul> 
				@foreach ($pdf_producers as $producer)
					<li>
						{{ HTML::link($HELP::url_slug(['/', 'all_pdf', '/', "$producer->producer"])."?producer_id=$producer->producer_id", $producer->producer) }}
					</li>	
				@endforeach 
			</ul>
		</div> --}}
	</div>	
@stop