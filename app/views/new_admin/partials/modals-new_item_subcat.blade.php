@section('modal-change-subcat')
	<div class="change_category_items_modal modal fade" tabindex="-1" role="dialog" id="changeSubcat">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true ">&times;</span>
					</button>
					<h4 class="modal-title admin_add_subcategory_title">Редактирование категории/подкатегории</h4>
				</div>
				<div class="modal-body">
					<div class="change_block admin_select_category_div">
						{{ Form::label('category', 'Категория', ['class'=>'admin_uni_label admin_select_category_label']) }}
						{{ Form::select('category', ['Механическое_en' => 'Механическое_en', 'Тепловое_en' => 'Тепловое_en','Холодильное_en' => 'Холодильное_en','Моечное_en' => 'Моечное_en','Механическое_ru' => 'Механическое_ru','Тепловое_ru' => 'Тепловое_ru','Холодильное_ru' => 'Холодильное_ru','Моечное_ru' => 'Моечное_ru'], '', ['class'=>'form-control admin_select_category_select a_i_s_c_l', 'required', 'form' => 'none']) }}
					</div>
					<div class="change_block admin_select_title_div">
						{{ Form::label('subcat_id', 'Подкатегория', ['class'=>'admin_uni_label admin_select_category_label ascl']) }}
						{{ Form::select('subcat_id', [], '', ['class'=>'form-control admin_select_title_text', 'required']) }}
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
					<a class="change_subcat_button btn admin_add_button aadb admin_uni_button ">Сохранить</a>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
@stop