@section ('left_sidebar')
	<div class="full_screen">
		<div class="admin_sidebar_container">
			<a href="/admin" class="@if ( $env == 'panel') active_my @endif admin_sidebar_button"><i class="fa fa-wrench"></i>Панель управления</a>
			<a href="/admin/change_item" class="@if ($env == 'change_item') active_my @endif admin_sidebar_button"><i class="fa fa-cart-plus"></i>Добавить товар</a>
			<a href="/admin/change_article" class="@if ($env == 'change_article') active_my @endif admin_sidebar_button"><i class="fa fa-bullhorn"></i>Добавить новость</a>
			<a href="/admin/subcats" class="@if ($env == 'subcats') active_my @endif admin_sidebar_button"><i class="fa fa-sitemap"></i>Подкатегории</a>
			<a href="/admin/catalog" class="@if ($env == 'catalog_admin') active_my @endif admin_sidebar_button"><i class="fa fa-book"></i>Каталог</a>
			<a href="/admin/articles" class="@if ($env == 'articles') active_my @endif admin_sidebar_button"><i class="fa fa-list-alt"></i>Новости</a>
			<a href="/admin/producers" class="@if ($env == 'producers') active_my @endif admin_sidebar_button"><i class="fa fa-users"></i>Производители</a>
		</div>
	</div>	
@stop