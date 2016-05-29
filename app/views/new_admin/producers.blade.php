@extends('new_admin/admin_layout')
@extends('new_admin/partials/header')
@extends('new_admin/partials/drawer')
@extends('new_admin/partials/footer')

@section('body')
	@include('partials/flash_messages')
	<div class="admin_main_content admin_main_content--producers mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
		{{--<a class="admin_producer_add mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">--}}
			{{--<i class="fa fa-plus">&nbsp</i>Добавить производителя--}}
		{{--</a>--}}
		<div class = "groups admin_producers_groups">
			@for($i=1; $i<=4; $i++)
				<ul class="producers_list producers_first">
					@foreach ($HELP::columnize($producers, 4, $i) as $key => $producer)
						@if ($producer->producer_id != 0)
							<li>
								<div class="admin_producer_one">
									{{ Form::open(array('url' => "/admin/ajax-delete-producer?producer_id=$producer->producer_id", 'method' => 'POST', 'class'=>'admin_producer_one_form')) }}
									<button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect delete_items_group_icon">
										<i class="material-icons">close</i>
									</button>
									{{ Form::close() }}
									<a href="/admin/change_producer?producer_id={{$producer->producer_id}}" class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect change">
										<i class="material-icons">mode_edit</i>
									</a>
									<p>{{$producer->producer}}</p>
								</div>
							</li>
						@endif
					@endforeach
				</ul>
			@endfor
		</div> <!-- groups  -->
	</div>
	<div class="add_btn" id="add_btn">
		<a href="/admin/change_producer" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
			<i class="material-icons">add</i>
		</a>
	</div>
	<div class="mdl-tooltip mdl-tooltip--top" for="add_btn">
		Добавить производителя
	</div>
@stop
