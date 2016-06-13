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

            <a class="mdl-navigation__link @if ( $env == 'pdfs') active_nav @endif" href="/admin/list_pdf">Деталировки</a>
            <a class="mdl-navigation__link @if ( $env == 'create_pdf' || $env == 'change_pdf' ) active_nav @endif" href="/admin/create_pdf">Добавить деталировку</a>
            <div class="mdl-navigation__devider"></div>

            <a class="mdl-navigation__link @if ( $env == 'admins') active_nav @endif" href="/admin/list_admins">Администраторы</a>
            <a class="mdl-navigation__link @if ( $env == 'new_admin' || $env == 'change_admin') active_nav @endif" href="/admin/change_admin">Добавить администратора</a>
			<div class="mdl-navigation__devider"></div>

			<a class="mdl-navigation__link" href="/admin/about"><i class="material-icons">help_outline</i></a>
		</nav>
    </div>
@stop