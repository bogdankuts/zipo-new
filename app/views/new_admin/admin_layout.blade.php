<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=1200'>
    <meta name='keywords' content='Оборудование для баров, кафе, ресторанов, комплексное оснащение баров, ксобровождение баров, техника для баров, кафе ресторанов, техника для общепита, открытие ресторана Россия, техника для точек питания, запчасти для техники, запчасти для барного оборудования, запчасти для холодильного оборудования, запчасти для пекарского оборудования, запчасти для производственного оборудования, запчасти для кафе, холодильное оборудование, барное оборудование, пекарское оборудование, нейтральное оборудование, Санкт-Петербург, Россия'>
    <meta name='description' content='Комплексное оснащение баров, ресторанов,кафе, пищевых производств и магазинов.'>
    @yield('meta')
    <title>Зип Общепит - Комплексное оснащение баров, ресторанов, кафе, пищевых производств и магазинов</title>
    <link rel="shortcut icon" href="{{ asset('img/markup/favicon_admin.ico') }}">

    {{--MATERIAL DESIGN--}}
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.red-orange.min.css" />
    <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	{{--CUSTOM STYLES--}}
	{{ HTML::style('css/style.css') }}
	{{ HTML::style('css/new_admin/style.css') }}

    {{--{{ HTML::script('ckeditor/ckeditor.js') }}--}}
    @yield('css')
</head>

<body>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
        @yield('header')
        @yield('drawer')
        <main class="mdl-layout__content mdl-color--grey-100">
            <div class="mdl-grid page-content">
                @yield('body')
            </div>
        </main>
        @yield('footer')
    </div>
    <script>
        {{--@include('partials/js_globals')--}}
        @yield('js')
    </script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    {{ HTML::script('js/new_admin.js') }}
	{{ HTML::script('js/common.js') }}
	{{ HTML::script('js/admin.js') }}
	@yield('head_js')

	@yield('modal-change-subcat')

</body>
</html>