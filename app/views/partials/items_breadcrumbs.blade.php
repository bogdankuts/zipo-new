@if ($env=='specials')
	<ol class="breadcrumb">
	  <li><a href="/">Каталог</a></li>
	  <li class="active">Спецпредложения</li>
	</ol>
	<h3 class="items_main_header universal_heading">Спецпредложения</h3>
@elseif ($env=='catalog')	
	<ol class="breadcrumb">
	  <li><a href="/">Каталог</a></li>
	  <li>
	  	<a href='{{URL::to($HELP::url_slug(["category", "/", "$current->category"]))}}'> {{$HELP::getNormal($current->category)}} оборудование</a></li>
	  <li class="active">{{$current->subcat}}</li>
	</ol>
	<h3 class="items_page_main_header universal_heading">{{$HELP::getNormal($current->category) }} оборудование</h3>
	<p class="items_subheading">{{$current->subcat}}</p>
@elseif ($env=='prods_by_subcat')	
	<ol class="breadcrumb">
	  <li><a href="/">Каталог</a></li>
	  <li>
	  	<a href='{{URL::to($HELP::url_slug(["category", "/", "$current->category"]))}}'> {{$HELP::getNormal($current->category)}} оборудование</a></li>
	  <li>
	  	<a href='{{URL::to($HELP::url_slug(["$current->category", "/", "$current->subcat"])."?subcat_id=$current->subcat_id")}}'>{{$current->subcat}}</a></li>
	  </li>
	  <li class="active">{{Producer::find(Input::get("producer_id"))->producer}}</li>
	</ol>
	{{HTML::link($HELP::url_slug(["/", "all_pdf", "/", Producer::find(Input::get('producer_id'))->producer, "/", $current->subcat])."?producer_id=".Producer::find(Input::get("producer_id"))->producer_id."&subcat_id=$current->subcat_id", "Посмотреть деталировки",['class'=>'btn watch_by_prod_btn watch_by_prod_and_subcat']) }}
	<h3 class="items_page_main_header universal_heading">{{$HELP::getNormal($current->category) }} оборудование</h3>
	<p class="items_subheading">{{$current->subcat}}</p>
	<p class="items_subheading sub_head_second"> производителя "{{Producer::find(Input::get("producer_id"))->producer}}"</p>
@elseif ($env=='byproducer')
	<ol class="breadcrumb">
	  <li><a href="/">Каталог</a></li>
	  <li class="active">{{$current->producer}}</li>
	</ol>
	{{HTML::link($HELP::url_slug(["/", "all_pdf", "/", $current->producer])."?producer_id=$current->producer_id", "Посмотреть деталировки",['class'=>'btn watch_by_prod_btn']) }}
	<h3 class="items_page_main_header universal_heading">{{$current->producer}}</h3>
@elseif ($env=='search')
	<h3 class="items_page_main_header universal_heading">Результаты поиска: {{$current}}</h3>
@endif