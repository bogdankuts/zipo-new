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
	{{ HTML::style('css/bootstrap.min.css') }}
	{{ HTML::style('css/font-awesome.min.css') }}
	{{ HTML::style('css/style.css') }}
	{{ HTML::style('css/flash_messages.css') }}
	{{ HTML::style('css/admin.css') }}
	{{ HTML::style('css/pdf.css') }}
	{{ HTML::style('css/magnific-popup.css') }}
	{{ HTML::style('css/animate-popup.css') }}
	{{ HTML::style('css/jquery-ui.min.css') }}
	{{ HTML::style('http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic&subset=latin,cyrillic-ext') }}
	{{ HTML::script('js/jquery.min.js') }}
	{{ HTML::script('js/jquery.magnific-popup.min.js') }}
	{{ HTML::script('ckeditor/ckeditor.js') }}
	{{ HTML::script('js/jquery.ui.widget.js') }}
	{{ HTML::script('js/jquery.iframe-transport.js') }}
	{{ HTML::script('js/jquery.fileupload.js') }}
	{{ HTML::script('js/bootstrap.min.js') }}
	{{ HTML::script('js/jquery-ui.min.js') }}

	@yield('css')
</head>

<body>
	@yield('header')
	@yield('left_sidebar')
	<div class="container_main">
		@yield('right_sidebar')
		@yield('body')
	</div>	
	@yield('footer')

	<script>
		@include('partials/js_globals')
		@yield('js')
	</script>
	{{ HTML::script('js/common.js') }}
	{{ HTML::script('js/admin.js') }}
</body>
</html>