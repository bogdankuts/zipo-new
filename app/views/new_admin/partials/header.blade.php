@section('header')
    <header class="mdl-layout__header mdl-layout__header--scroll">
        <div class="mdl-layout__header-row">
            <span class="mdl-layout-title">{{$pageTitle}}</span>
            <!-- Add spacer, to align navigation to the right -->
            <div class="mdl-layout-spacer"></div>
            <!-- Navigation. We hide it in small screens. -->
            <nav class="mdl-navigation mdl-layout--large-screen-only">
                <p class="mdl-navigation__link">Привет, {{Auth::admin()->get()->login}}</p>
                <a class="mdl-navigation__link" href="/" target="_blank">
                    Перейти на сайт <i class="material-icons">link</i>
                </a>
                <a class="mdl-navigation__link" href="/admin/admin_logout">
                    Выйти <i class="material-icons">exit_to_app</i>
                </a>
            </nav>
        </div>
    </header>
@stop