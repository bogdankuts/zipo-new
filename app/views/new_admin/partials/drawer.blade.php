@section('drawer')
    <div class="mdl-layout__drawer">
        <span class="mdl-layout-title">Привет, {{Auth::admin()->get()->login}}</span>
        <nav class="mdl-navigation">

            <a class="mdl-navigation__link @if ( $env == 'dashboard') active_nav @endif" href="/admin">Панель управления</a>
            <div class="mdl-navigation__devider"></div>

            <a class="mdl-navigation__link @if ( $env == 'catalog_admin') active_nav @endif" href="/admin/catalog">Товары</a>
            <a class="mdl-navigation__link @if ( $env == 'change_item') active_nav @endif" href="/admin/change_item">Добавить товар</a>
            <div class="mdl-navigation__devider"></div>
            <a class="mdl-navigation__link @if ( $env == 'articles') active_nav @endif" href="/admin/articles">Новости</a>
            <a class="mdl-navigation__link @if ( $env == 'change_article') active_nav @endif" href="/admin/change_article">Добавить новость</a>
            <div class="mdl-navigation__devider"></div>

            <a class="mdl-navigation__link @if ( $env == 'producers') active_nav @endif" href="/admin/producers">Производители</a>
            <a class="mdl-navigation__link @if ( $env == 'change_producer') active_nav @endif" href="/admin/change_producer">Добавить прозводителя</a>
            <div class="mdl-navigation__devider"></div>

			<a class="mdl-navigation__link @if ( $env == 'subcategories') active_nav @endif" href="/admin/subcategories">Подкатегории</a>
			<div class="mdl-navigation__devider"></div>

            <a class="mdl-navigation__link @if ( $env == 'orders' || $env == 'order') active_nav @endif" href="/admin/orders">Заказы</a>
            <a class="mdl-navigation__link @if ( $env == 'clients' || $env == 'client') active_nav @endif" href="/admin/clients">Клиенты</a>
            <a class="mdl-navigation__link @if ( $env == 'users' || $env == 'user') active_nav @endif" href="/admin/users">Пользователи</a>
            <div class="mdl-navigation__devider"></div>

            <a class="mdl-navigation__link" href="">Деталировки</a>
            <a class="mdl-navigation__link" href="">Добавить деталировку</a>
            <div class="mdl-navigation__devider"></div>

            <a class="mdl-navigation__link" href="">Администраторы</a>
            <a class="mdl-navigation__link" href="">Добавить администратора</a>
        </nav>
    </div>
@stop


{{--<a href="/admin/change_item" class="@if ($env == 'change_item') active_my @endif admin_sidebar_button"><i class="fa fa-cart-plus"></i>Добавить товар</a>--}}
{{--<a href="/admin/change_article" class="@if ($env == 'change_article') active_my @endif admin_sidebar_button"><i class="fa fa-bullhorn"></i>Добавить новость</a>--}}
{{--<a href="/admin/subcats" class="@if ($env == 'subcats') active_my @endif admin_sidebar_button"><i class="fa fa-sitemap"></i>Подкатегории</a>--}}
{{--<a href="/admin/catalog" class="@if ($env == 'catalog_admin') active_my @endif admin_sidebar_button"><i class="fa fa-book"></i>Каталог</a>--}}
{{--<a href="/admin/articles" class="@if ($env == 'articles') active_my @endif admin_sidebar_button"><i class="fa fa-list-alt"></i>Новости</a>--}}
{{--<a href="/admin/producers" class="@if ($env == 'producers') active_my @endif admin_sidebar_button"><i class="fa fa-users"></i>Производители</a>--}}