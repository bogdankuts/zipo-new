@extends('partials/admin_layout')
@extends('partials/admin_header')
@extends('partials/admin_sidebar')
@extends('partials/admin_footer')

@section('body')
	@include('partials/flash_messages')
	<div id="preloader" style="position: fixed; left: 0;  top: 0;  z-index: 999;  width: 100%;  height: 100%;  overflow: visible;  background: #333 url('//cdnjs.cloudflare.com/ajax/libs/file-uploader/3.7.0/processing.gif') no-repeat center center;"></div>
	<div class="admin_main_content">
		<ul class="all_pdfs">
			@foreach ($pdfs as $pdf)
				<li>
					<a>
						<i class="fa fa-pencil upd_pdf change_icon_pdf_{{ $pdf->pdf_id }}"></i>
					</a>
					{{ Form::open(array('url' => "/admin/delete_pdf?pdf_id=$pdf->pdf_id", 'method' => 'POST', 'class'=>'admin_del_pdf_form ')) }}
					<i class="fa fa-times del_pdf"></i>
					{{ Form::submit('Сохранить', ['class'=>'hidden']) }}
					{{ Form::close() }}
					{{HTML::link("admin/item_pdfs?pdf_id=$pdf->pdf_id&producer_id=$pdf->producer_id", $pdf->good,['target'=>'_blank']) }}
					<div class="admin_change_subcategory_div adm_upd_pdf_{{$pdf->pdf_id}} adm_pdf_change_pop_up mfp-hide mfp-zoom-out" data-effect="mfp-zoom-out">
						{{ Form::model($pdf, ['url'=>"admin/update_pdf", 'method'=>'POST', 'class'=>'admin_add_pdf_form input-group']) }}
						{{ Form::hidden('pdf_id', $pdf->pdf_id) }}
						<p class="admin_add_subcategory_title">Редактирование деталировки</p>
						<div class="change_block admin_id_subcategory_div">
							<p class="admin_uni_label admin_id_subcategory_title">ID деталировки</p>
							<p class="admin_id_subcategory_id">{{$pdf->pdf_id}}</p>
						</div>
						<div class="change_block admin_select_category_div">
							{{ Form::label('producer_id', 'Производитель', ['class'=>'admin_uni_label admin_select_category_label']) }}
							{{ Form::select('producer_id', $HELP::createOptions($producers, 'producer_id', 'producer'), $pdf->producer_id, ['class'=>'form-control admin_select_category_select', 'required']) }}
						</div>
						<div class="change_block admin_select_title_div">
							{{ Form::label('good', 'Название товара', ['class'=>'admin_uni_label admin_select_title_label']) }}
							{{ Form::text('good', $pdf->good, ['class'=>'form-control admin_select_title_text', 'required']) }}
						</div>
						<div class="change_block change_item_category_div">
							{{ Form::label('category', 'Категория', ['class'=>'admin_uni_label category_main_label']) }}
							{{ Form::select('category',
                                ['other'=>'Не указано', 'Механическое_en' => 'Механическое_en', 'Тепловое_en' => 'Тепловое_en','Холодильное_en' => 'Холодильное_en','Моечное_en' => 'Моечное_en','Механическое_ru' => 'Механическое_ru','Тепловое_ru' => 'Тепловое_ru','Холодильное_ru' => 'Холодильное_ru','Моечное_ru' => 'Моечное_ru'],
                                null,
                                ['class'=>'form-control category_input js_select_category', 'required','form' => 'other'])
                            }}
						</div>
						<div class="change_block change_item_subcat_div">
							{{ Form::label('subcat_id', 'Подкатегория', ['class'=>'admin_uni_label subcat_main_label']) }}
							@if (isset($pdf))
								{{ Form::select('subcat_id',
                                     [],
                                     $pdf->subcat_id,
                                     ['class'=>'form-control subcat_input js_select_subcat', 'required', 'data-id'=>"$pdf->subcat_id"])
                                 }}
							@else
								{{ Form::select('subcat_id',
                                    [],
                                    null,
                                    ['class'=>'form-control subcat_input js_select_subcat', 'required'])
                                }}
							@endif
						</div>
						{{ Form::submit('Изменить', ['class'=>'btn admin_add_button admin_uni_button ']) }}
						{{ Form::close() }}
					</div> <!--admin_add_subcategory_div-->
					<script>
						// admin change subcategory
						$('.change_icon_pdf_{{$pdf->pdf_id}}').magnificPopup({
							items: {
								src: '.adm_upd_pdf_{{$pdf->pdf_id}}', // CSS selector of an element on page that should be used as a popup
								type: 'inline'
							},
						});
						jQuery(document).ready(function($) {
							$(window).load(function() {
								$('#preloader').fadeOut('slow', function() {});
							});
						});
					</script>
				</li>
			@endforeach
		</ul>
	</div>
@stop