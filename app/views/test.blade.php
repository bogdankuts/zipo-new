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
				@foreach($producers_ru as $produser)
					<div class="catalog_category" data-category='{{$producer->subcat_id}}'>
						<img src="img/markup/kateg_{{$producer->category}}.png" alt="" class="catalog_category_img">
						<p class="catalog_category_heading">{{$producer->category}}<br> оборудование</p>
					</div>
					<div class="subcategory_block sub_1" data-category='{{$producer->subcat_id}}'>
						<div class="subcategory_column">
							<div class="subcategory_left">
								<ul>
									@foreach ($HELP::columnize($producers['{{$producer->subcat_id}}'], 2, 1) as $one_producer)
										<li>
											{{ HTML::link($HELP::url_slug(['/', 'all_pdf', '/', "$one_producer->producer"])."?producer_id=$one_producer->producer_id", $one_producer->producer) }}
										</li>
									@endforeach
								</ul>
							</div>
							<div class="subcategory_right">
								<ul>	
									@foreach ($HELP::columnize($producers['{{$producer->subcat_id}}'], 2, 2) as $one_producer)
										<li>
											{{ HTML::link($HELP::url_slug(['/', 'all_pdf', '/', "$one_producer->producer"])."?producer_id=$one_producer->producer_id", $one_producer->producer) }}
										</li>
									@endforeach
								</ul>	
							</div>	
						</div><!-- brands_column -->
					</div><!-- subcategory block -->
				@endforeach
			</div>		
			<div class="catalog_russian">
				<h4 class="russian_heding">Отечественное</h4>
				@foreach($producers_en as $produser)
					<div class="catalog_category" data-category='{{$producer->subcat_id}}'>
						<img src="img/markup/kateg_{{$producer->category}}.png" alt="" class="catalog_category_img">
						<p class="catalog_category_heading">{{$producer->category}}<br> оборудование</p>
					</div>
					<div class="subcategory_block sub_1" data-category='{{$producer->subcat_id}}'>
						<div class="subcategory_column">
							<div class="subcategory_left">
								<ul>
									@foreach ($HELP::columnize($producers['{{$producer->subcat_id}}'], 2, 1) as $one_producer)
										<li>
											{{ HTML::link($HELP::url_slug(['/', 'all_pdf', '/', "$one_producer->producer"])."?producer_id=$one_producer->producer_id", $one_producer->producer) }}
										</li>
									@endforeach
								</ul>one_
							</div>
							<div class="subcategory_right">
								<ul>	
									@foreach ($HELP::columnize($producers['{{$producer->subcat_id}}'], 2, 2) as $one_producer)
										<li>
											{{ HTML::link($HELP::url_slug(['/', 'all_pdf', '/', "$one_producer->producer"])."?producer_id=$one_producer->producer_id", $one_producer->producer) }}
										</li>
									@endforeach
								</ul>	
							</div>	
						</div><!-- brands_column -->
					</div><!-- subcategory block -->
				@endforeach	
			</div><!--catalog_russian-->	
		</div>
	</div>	
@stop