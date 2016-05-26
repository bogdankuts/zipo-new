@extends('partials/layout')
@extends('partials/header')
@extends('partials/footer')
@extends('partials/left_sidebar')
@extends('partials/right_sidebar')
@section('meta')
	<title>Все производители подкатегории: {{$current->subcat}}</title>
	<meta name='keywords' content='Все производители подкатегории: {{$current->subcat}} - Зип Общепит'>
	<meta name='description' content='Все производители подкатегории: {{$current->subcat}} - Зип Общепит'>
@stop

@section('body')
	<div class="main_content">
		<ol class="breadcrumb">
		  <li><a href="/">Каталог</a></li>
		  <li>
		  	<a href='{{URL::to($HELP::url_slug(["category", "/", "$current->category"]))}}'> {{$HELP::getNormal($current->category)}} оборудование</a></li>
		  <li class="active">{{$current->subcat}}</li>
		</ol>
		<h3 class="items_page_main_header universal_heading">{{$HELP::getNormal($current->category) }} оборудование</h3>
		<p class="items_subheading">{{$current->subcat}} сгрупированные по производителю</p>
		<hr class="main_hr">
		
		<div>
			<ul class="prod_by_subcat_list">
				@foreach ($producers as $producer)
					<li>
						<a href='{{$HELP::url_slug(["/", "$current->category", "/", "$current->subcat", "/", "$producer->producer", "/", "items"])."?subcat_id=$current->subcat_id&producer_id=$producer->producer_id"}}'>
							<p>{{$producer->producer}}</p>
							<div class="prods_by_subcat_img_wrap">
								<img src="/img/photos/{{$producer->producer_photo}}" alt="{{$producer->producer}}" class="prods_by_subcat_img">
							</div>
						</a>
					</li>
				@endforeach
			</ul>
		</div>
	</div>	
@stop