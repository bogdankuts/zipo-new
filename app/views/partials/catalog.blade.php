@section('body')
	@if (Session::get('message'))
		<div class="message alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><i aria-hidden="true" class="fa fa-times close_message"></i></button>
			<p class="message_text">{{ Session::get('message') }}</p>
		</div>	
	@endif
	<div class="main_content">
		<div class="headings">
			<p class="catalog_heding universal_heading">Каталог продукции</p>
			<p class="catalog_subheading">По виду продукции</p>
			<hr class="catalog_hr">
		</div>
		<div class="catalog_categoies">
			<div class="catalog_foreing">
				<h4 class="foreign_heding">Импортное</h4>
				<div class="catalog_category" data-category='Механическое_en'>
					@if ($env == 'catalog_admin')
						<img src="../../img/markup/kateg_mech.png" alt="" class="catalog_category_img">
					@else
						<img src="img/markup/kateg_mech.png" alt="" class="catalog_category_img">
					@endif	
					<p class="catalog_category_heading">Механическое<br> оборудование</p>
				</div>

				<div class="catalog_category" data-category='Тепловое_en'>
					@if ($env == 'catalog_admin')
						<img src="../../img/markup/kateg_tepl.png" alt="" class="catalog_category_img">
					@else
						<img src="img/markup/kateg_tepl.png" alt="" class="catalog_category_img">
					@endif
					<p class="catalog_category_heading">Тепловое<br> оборудование</p>
				</div>
				<div class="subcategory_block sub_1" data-category='Механическое_en'>
					<div class="subcategory_column">
						<div class="subcategory_left">
							<ul>
								@foreach ($HELP::columnize($subcats['Механическое_en'], 2, 1) as $subcat)
									<li>
										@if ($env == 'catalog_admin')
											{{ HTML::link($HELP::url_slug(['/', 'admin', '/', 'Механическое', '/', "$subcat->subcat"])."?subcat_id=$subcat->subcat_id", $subcat->subcat) }}
										@else
											{{ HTML::link($HELP::url_slug(['/', 'Механическое', '/', "$subcat->subcat"])."?subcat_id=$subcat->subcat_id", $subcat->subcat) }}
										@endif
									</li>
								@endforeach
							</ul>
						</div>
						<div class="subcategory_right">
							<ul>	
								@foreach ($HELP::columnize($subcats['Механическое_en'], 2, 2) as $subcat)
									<li>
										@if ($env == 'catalog_admin')
											{{ HTML::link($HELP::url_slug(['/', 'admin', '/', 'Механическое', '/', "$subcat->subcat"])."?subcat_id=$subcat->subcat_id", $subcat->subcat) }}
										@else
											{{ HTML::link($HELP::url_slug(['/', 'Механическое', '/', "$subcat->subcat"])."?subcat_id=$subcat->subcat_id", $subcat->subcat) }}
										@endif
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
								@foreach ($HELP::columnize($subcats['Тепловое_en'], 2, 1) as $subcat)
									<li>
										@if ($env == 'catalog_admin')
											{{ HTML::link($HELP::url_slug(['/', 'admin', '/', 'Тепловое', '/', "$subcat->subcat"])."?subcat_id=$subcat->subcat_id", $subcat->subcat) }}
										@else
											{{ HTML::link($HELP::url_slug(['/', 'Тепловое', '/', "$subcat->subcat"])."?subcat_id=$subcat->subcat_id", $subcat->subcat) }}
										@endif
									</li>
								@endforeach
							</ul>
						</div>	
						<div class="subcategory_right">
							<ul>	
								@foreach ($HELP::columnize($subcats['Тепловое_en'], 2, 2) as $subcat)
									<li>
										@if ($env == 'catalog_admin')
											{{ HTML::link($HELP::url_slug(['/', 'admin', '/', 'Тепловое', '/', "$subcat->subcat"])."?subcat_id=$subcat->subcat_id", $subcat->subcat) }}
										@else
											{{ HTML::link($HELP::url_slug(['/', 'Тепловое', '/', "$subcat->subcat"])."?subcat_id=$subcat->subcat_id", $subcat->subcat) }}
										@endif
									</li>
								@endforeach
							</ul>	
						</div>
					</div><!-- brands_column -->
				</div><!-- subcategory block -->
				<div class="catalog_category" data-category='Холодильное_en'>
					@if ($env == 'catalog_admin')
						<img src="../../img/markup/kateg_holod.png" alt="" class="catalog_category_img">
					@else
						<img src="img/markup/kateg_holod.png" alt="" class="catalog_category_img">
					@endif	
					<p class="catalog_category_heading">Холодильное<br> оборудование</p>
				</div>
				<div class="catalog_category posud_catedory" data-category='Моечное_en'>
					@if ($env == 'catalog_admin')
						<img src="../../img/markup/kateg_posud.png" alt="" class="catalog_category_img">
					@else
						<img src="img/markup/kateg_posud.png" alt="" class="catalog_category_img">
					@endif
					<p class="catalog_category_heading">Моечное<br> оборудование</p>
				</div>
				<div class="subcategory_block " data-category='Холодильное_en'>
					<div class="subcategory_column">
						<div class="subcategory_left">
							<ul>
								@foreach ($HELP::columnize($subcats['Холодильное_en'], 2, 1) as $subcat)
									<li>
										@if ($env == 'catalog_admin')
											{{ HTML::link($HELP::url_slug(['/', 'admin', '/', 'Холодильное', '/', "$subcat->subcat"])."?subcat_id=$subcat->subcat_id", $subcat->subcat) }}
										@else
											{{ HTML::link($HELP::url_slug(['/', 'Холодильное', '/', "$subcat->subcat"])."?subcat_id=$subcat->subcat_id", $subcat->subcat) }}
										@endif
									</li>
								@endforeach
							</ul>
						</div>	
						<div class="subcategory_right">
							<ul>	
								@foreach ($HELP::columnize($subcats['Холодильное_en'], 2, 2) as $subcat)
									<li>
										@if ($env == 'catalog_admin')
											{{ HTML::link($HELP::url_slug(['/', 'admin', '/', 'Холодильное', '/', "$subcat->subcat"])."?subcat_id=$subcat->subcat_id", $subcat->subcat) }}
										@else
											{{ HTML::link($HELP::url_slug(['/', 'Холодильное', '/', "$subcat->subcat"])."?subcat_id=$subcat->subcat_id", $subcat->subcat) }}
										@endif
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
								@foreach ($HELP::columnize($subcats['Моечное_en'], 2, 1) as $subcat)
									<li>
										@if ($env == 'catalog_admin')
											{{ HTML::link($HELP::url_slug(['/', 'admin', '/', 'Моечное', '/', "$subcat->subcat"])."?subcat_id=$subcat->subcat_id", $subcat->subcat) }}
										@else
											{{ HTML::link($HELP::url_slug(['/', 'Моечное', '/', "$subcat->subcat"])."?subcat_id=$subcat->subcat_id", $subcat->subcat) }}
										@endif
									</li>
								@endforeach
							</ul>
						</div>	
						<div class="subcategory_right">
							<ul>	
								@foreach ($HELP::columnize($subcats['Моечное_en'], 2, 2) as $subcat)
									<li>
										@if ($env == 'catalog_admin')
											{{ HTML::link($HELP::url_slug(['/', 'admin', '/', 'Моечное', '/', "$subcat->subcat"])."?subcat_id=$subcat->subcat_id", $subcat->subcat) }}
										@else
											{{ HTML::link($HELP::url_slug(['/', 'Моечное', '/', "$subcat->subcat"])."?subcat_id=$subcat->subcat_id", $subcat->subcat) }}
										@endif
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
					@if ($env == 'catalog_admin')
						<img src="../../img/markup/kateg_mech.png" alt="" class="catalog_category_img">
					@else
						<img src="img/markup/kateg_mech.png" alt="" class="catalog_category_img">
					@endif	
					<p class="catalog_category_heading">Механическое<br> оборудование</p>
				</div>
				<div class="catalog_category" data-category='Тепловое_ru'>
					@if ($env == 'catalog_admin')
						<img src="../../img/markup/kateg_tepl.png" alt="" class="catalog_category_img">
					@else
						<img src="img/markup/kateg_tepl.png" alt="" class="catalog_category_img">
					@endif
					<p class="catalog_category_heading">Тепловое<br> оборудование</p>
				</div>
				<div class="subcategory_block" data-category='Механическое_ru'>
					<div class="subcategory_column">
						<div class="subcategory_left">
							<ul>
								@foreach ($HELP::columnize($subcats['Механическое_ru'], 2, 1) as $subcat)
									<li>
										@if ($env == 'catalog_admin')
											{{ HTML::link($HELP::url_slug(['/', 'admin', '/', 'Механическое', '/', "$subcat->subcat"])."?subcat_id=$subcat->subcat_id", $subcat->subcat) }}
										@else
											{{ HTML::link($HELP::url_slug(['/', 'Механическое', '/', "$subcat->subcat"])."?subcat_id=$subcat->subcat_id", $subcat->subcat) }}
										@endif
									</li>
								@endforeach
							</ul>
						</div>
						<div class="subcategory_right">
							<ul>	
								@foreach ($HELP::columnize($subcats['Механическое_ru'], 2, 2) as $subcat)
									<li>
										@if ($env == 'catalog_admin')
											{{ HTML::link($HELP::url_slug(['/', 'admin', '/', 'Механическое', '/', "$subcat->subcat"])."?subcat_id=$subcat->subcat_id", $subcat->subcat) }}
										@else
											{{ HTML::link($HELP::url_slug(['/', 'Механическое', '/', "$subcat->subcat"])."?subcat_id=$subcat->subcat_id", $subcat->subcat) }}
										@endif
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
								@foreach ($HELP::columnize($subcats['Тепловое_ru'], 2, 1) as $subcat)
									<li>
										@if ($env == 'catalog_admin')
											{{ HTML::link($HELP::url_slug(['/', 'admin', '/', 'Тепловое', '/', "$subcat->subcat"])."?subcat_id=$subcat->subcat_id", $subcat->subcat) }}
										@else
											{{ HTML::link($HELP::url_slug(['/', 'Тепловое', '/', "$subcat->subcat"])."?subcat_id=$subcat->subcat_id", $subcat->subcat) }}
										@endif
									</li>
								@endforeach
							</ul>
						</div>	
						<div class="subcategory_right">
							<ul>	
								@foreach ($HELP::columnize($subcats['Тепловое_ru'], 2, 2) as $subcat)
									<li>
										@if ($env == 'catalog_admin')
											{{ HTML::link($HELP::url_slug(['/', 'admin', '/', 'Тепловое', '/', "$subcat->subcat"])."?subcat_id=$subcat->subcat_id", $subcat->subcat) }}
										@else
											{{ HTML::link($HELP::url_slug(['/', 'Тепловое', '/', "$subcat->subcat"])."?subcat_id=$subcat->subcat_id", $subcat->subcat) }}
										@endif
									</li>
								@endforeach
							</ul>	
						</div>
					</div><!-- brands_column -->
				</div><!-- subcategory block -->
				<div class="catalog_category" data-category='Холодильное_ru'>
					@if ($env == 'catalog_admin')
						<img src="../../img/markup/kateg_holod.png" alt="" class="catalog_category_img">
					@else
						<img src="img/markup/kateg_holod.png" alt="" class="catalog_category_img">
					@endif
					<p class="catalog_category_heading">Холодильное<br> оборудование</p>
				</div>
				<div class="catalog_category posud_catedory" data-category='Моечное_ru'>
					@if ($env == 'catalog_admin')
						<img src="../../img/markup/kateg_posud.png" alt="" class="catalog_category_img">
					@else
						<img src="img/markup/kateg_posud.png" alt="" class="catalog_category_img">
					@endif

					<p class="catalog_category_heading">Моечное<br> оборудование</p>
				</div>
				<div class="subcategory_block second_line" data-category='Холодильное_ru'>
					<div class="subcategory_column">
						<div class="subcategory_left">
							<ul>
								@foreach ($HELP::columnize($subcats['Холодильное_ru'], 2, 1) as $subcat)
									<li>
										@if ($env == 'catalog_admin')
											{{ HTML::link($HELP::url_slug(['/', 'admin', '/', 'Холодильное', '/', "$subcat->subcat"])."?subcat_id=$subcat->subcat_id", $subcat->subcat) }}
										@else
											{{ HTML::link($HELP::url_slug(['/', 'Холодильное', '/', "$subcat->subcat"])."?subcat_id=$subcat->subcat_id", $subcat->subcat) }}
										@endif
									</li>
								@endforeach
							</ul>
						</div>	
						<div class="subcategory_right">
							<ul>	
								@foreach ($HELP::columnize($subcats['Холодильное_ru'], 2, 2) as $subcat)
									<li>
										@if ($env == 'catalog_admin')
											{{ HTML::link($HELP::url_slug(['/', 'admin', '/', 'Холодильное', '/', "$subcat->subcat"])."?subcat_id=$subcat->subcat_id", $subcat->subcat) }}
										@else
											{{ HTML::link($HELP::url_slug(['/', 'Холодильное', '/', "$subcat->subcat"])."?subcat_id=$subcat->subcat_id", $subcat->subcat) }}
										@endif
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
								@foreach ($HELP::columnize($subcats['Моечное_ru'], 2, 1) as $subcat)
									<li>
										@if ($env == 'catalog_admin')
											{{ HTML::link($HELP::url_slug(['/', 'admin', '/', 'Моечное', '/', "$subcat->subcat"])."?subcat_id=$subcat->subcat_id", $subcat->subcat) }}
										@else
											{{ HTML::link($HELP::url_slug(['/', 'Моечное', '/', "$subcat->subcat"])."?subcat_id=$subcat->subcat_id", $subcat->subcat) }}
										@endif
									</li>
								@endforeach
							</ul>
						</div>	
						<div class="subcategory_right">
							<ul>	
								@foreach ($HELP::columnize($subcats['Моечное_ru'], 2, 2) as $subcat)
									<li>
										@if ($env == 'catalog_admin')
											{{ HTML::link($HELP::url_slug(['/', 'admin', '/', 'Моечное', '/', "$subcat->subcat"])."?subcat_id=$subcat->subcat_id", $subcat->subcat) }}
										@else
											{{ HTML::link($HELP::url_slug(['/', 'Моечное', '/', "$subcat->subcat"])."?subcat_id=$subcat->subcat_id", $subcat->subcat) }}
										@endif
									</li>
								@endforeach
							</ul>	
						</div>
					</div><!-- brands_column -->
				</div><!-- subcategory block -->
			</div><!--catalog_russian-->	
		</div>
		<div class="catalog_producers">
			<div class="producers_block_heding">
				<p class="catalog_subheading subheading_brands sub_moz">По производителю</p>
				<hr class="catalog_hr">
			</div>	
			<div class = "groups">
				<div class="brands_column">
					<div class="producers_left">
						<table class="producers_list producers_list_cat producers_left producers_left_t">
							@foreach ($HELP::columnize($producers, 2, 1) as $producer)
								<tr>
									<td>
										@if ($env == 'catalog_admin')
											{{ HTML::link($HELP::url_slug(['/', 'admin', '/', 'producers', '/', "$producer->producer"])."?producer_id=$producer->producer_id", $producer->producer) }}
										@else
											<div class="producer_two_links">
												{{ HTML::link($HELP::url_slug(['/', 'producers', '/', "$producer->producer"])."?producer_id=$producer->producer_id", $producer->producer,['class'=>'prod_a']) }}
												{{ HTML::link($HELP::url_slug(['/', 'producers', '/', "$producer->producer"])."?producer_id=$producer->producer_id", $producer->producer,['class'=>'full_prod_a']) }}
											</div>
										@endif
									</td>
								</tr>
							@endforeach
						</table>
					</div>
					{{-- <div class="producers_middle">
						<table class="producers_list producers_list_cat producers_middle">
							@foreach ($HELP::columnize($producers, 2, 2) as $producer)
								<tr>
									<td>
										@if ($env == 'catalog_admin')
											{{ HTML::link($HELP::url_slug(['/', 'admin', '/', 'producers', '/', "$producer->producer"])."?producer_id=$producer->producer_id", $producer->producer) }}
										@else
											{{ HTML::link($HELP::url_slug(['/', 'producers', '/', "$producer->producer"])."?producer_id=$producer->producer_id", $producer->producer) }}
										@endif
									</td>
								</tr>	
							@endforeach
						</table>	
					</div> --}}
					<div class="producers_right">
						<table class="producers_list producers_list_cat producers_right producers_right_t">
							@foreach ($HELP::columnize($producers, 2, 2) as $producer)
								<tr>
									<td>
										@if ($env == 'catalog_admin')
											{{ HTML::link($HELP::url_slug(['/', 'admin', '/', 'producers', '/', "$producer->producer"])."?producer_id=$producer->producer_id", $producer->producer) }}
										@else
											<div class="producer_two_links">
												{{ HTML::link($HELP::url_slug(['/', 'producers', '/', "$producer->producer"])."?producer_id=$producer->producer_id", $producer->producer,['class'=>'prod_a']) }}
												{{ HTML::link($HELP::url_slug(['/', 'producers', '/', "$producer->producer"])."?producer_id=$producer->producer_id", $producer->producer,['class'=>'full_prod_a']) }}
											</div>
										@endif
									</td>
								</tr>	
							@endforeach
						</table>
					</div>	
				</div><!-- brands_column -->
			</div><!-- brands -->
		</div> <!-- groups  -->
	</div>
@stop