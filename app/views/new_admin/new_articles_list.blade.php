@extends('new_admin/admin_layout')
@extends('new_admin/partials/header')
@extends('new_admin/partials/drawer')
@extends('new_admin/partials/footer')

@section('body')
	<div class="new_admins_list mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
		@foreach ($newArticles as $article)
			<div class="admin-card admin-card--articles mdl-card mdl-shadow--2dp">
				<div class="">
					<div class="admin_article_img_container">
						<img src="/img/photos/{{$article->photo}}" alt="{{$article->title}}" class="admin_article_min_img">
					</div>
					<h2 class="admin_article_heading">
						<a href='{{URL::to("admin/change_article?article_id=$article->article_id")}}'>{{$article->title}}</a>
					</h2>
				</div>
				<div class="mdl-card__supporting-text">
					<table class="mdl-data-table mdl-js-data-table">
						<tbody>
						<tr>
							<td class="mdl-data-table__cell--non-numeric">Дата</td>
							<td>{{$article->time}}</td>
						</tr>
						</tbody>
					</table>
				</div>
				<div class="mdl-card__actions">
					<a href="/articles/{{$HELP::url_slug(["$article->title"])}}?article_id={{$article->article_id}}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
						Подробнее
					</a>
					<a href="{{URL::to("admin/change_article?article_id=$article->article_id")}}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
						Изменить
					</a>
				</div>
			</div>
		@endforeach
	</div>

@stop
