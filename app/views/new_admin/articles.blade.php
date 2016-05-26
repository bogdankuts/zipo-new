@extends('new_admin/admin_layout')
@extends('new_admin/partials/header')
@extends('new_admin/partials/drawer')
@extends('new_admin/partials/footer')

@section('body')
	@include('partials/flash_messages')
	<div class="new_admins_list--items mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
		{{--<a href="/admin/change_article" class="admin_article_add"><i class="fa fa-plus"></i>Добавить новость</a>--}}
		@foreach ($articles as $article)
			<div class="admin_articles_one">
				<div class="article_more">
					<!-- Right aligned menu below button -->
					<button id="{{$article->article_id}}-menu-trigger" class="mdl-button mdl-js-button mdl-button--icon admin_item_menu_trigger">
						<i class="material-icons">more_vert</i>
					</button>
					<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="{{$article->article_id}}-menu-trigger">
						{{--<li class="mdl-menu__item">--}}
							<a href='{{URL::to("admin/change_article?article_id=$article->article_id")}}' class="mdl-menu__item">
								Изменить
							</a>
						{{--</li>--}}
						{{ Form::open(array('url' => "/admin/ajax-delete-article?article_id=$article->article_id", 'method' => 'POST', 'class'=>'admin_producer_one_form')) }}
						<li class="mdl-menu__item delete_items_group_icon">
							Удалить
						</li>
						{{ Form::close() }}
					</ul>
				</div>
				<div class="img_block">
					<a href='{{URL::to("admin/change_article?article_id=$article->article_id")}}' class="article_link">
						<img src="/img/photos/{{$article->photo}}" alt="{{$article->title}}" class="admin_article_minimg">
					</a>
				</div>
				<p class="admin_article_date">
					{{$article->time}}&nbsp&nbsp&nbsp
				</p>
				@if (strLen($article->title) <=60)
					<div class="admin_article_title">
						<a href='{{URL::to("admin/change_article?article_id=$article->article_id")}}' class="admin_article_title_1">{{$article->title}}</a>
						<a href='{{URL::to("admin/change_article?article_id=$article->article_id")}}' class="admin_article_title_1 admin_article_title_full">{{$article->title}}</a>
					</div>
				@else
					<div class="admin_article_title">
						<a href='{{URL::to("admin/change_article?article_id=$article->article_id")}}' class="admin_article_title_1">{{mb_substr ($article->title, 0, 27)}} ...</a>
						<a href='{{URL::to("admin/change_article?article_id=$article->article_id")}}' class="admin_article_title_1 admin_article_title_full">{{$article->title}}</a>
					</div>
				@endif
			</div>
		@endforeach
	</div>
@stop
@section('specific_page_js')
	{{ HTML::script('js/admin/articles.js') }}
@stop