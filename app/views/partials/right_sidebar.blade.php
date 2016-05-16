@section('right_sidebar') 
  <div class="right_sidebar">	
	<div class="container_sidebar">
			<div class="articles">
				<a href="/articles" class="articles_heading">Новости</a>
				<?php $i=0; ?>
				@foreach ($articles as $article)
					<div class="article">
						<a href='/articles/{{$HELP::url_slug(["$article->title"])}}?article_id={{$article->article_id}}' class="article_link">
							<img src="/img/photos/{{$article->photo}}" alt="{{$article->title}}" class="article_minimage">
						</a>
						<p class="right_sidebar_article_date">{{ $HELP::formatDate($article->time) }}</p>
						@if (strLen($article->title) <=60)
						  <div class="article_title">
							<a href='/articles/{{$HELP::url_slug(["$article->title"])}}?article_id={{$article->article_id}}' class="article_title_1">{{$article->title}}</a>
							<a href='/articles/{{$HELP::url_slug(["$article->title"])}}?article_id={{$article->article_id}}' class="article_title_1 article_title_full">{{$article->title}}</a>
						  </div>
						@else
						  <div class="article_title">
							<a href='/articles/{{$HELP::url_slug(["$article->title"])}}?article_id={{$article->article_id}}' class="article_title_1">{{mb_substr ($article->title, 0, 27)}} ...</a>
							<a href='/articles/{{$HELP::url_slug(["$article->title"])}}?article_id={{$article->article_id}}' class="article_title_1 article_title_full">{{$article->title}}</a>
						  </div> 
						@endif 
					</div>
				<?php if ($i++ == 3) break; ?> 
				@endforeach
				<a href="/articles" class="articles_all_link">Все новости >> </a>
			</div>
	</div>
  </div>    
@stop    
