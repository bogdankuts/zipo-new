@extends('partials/admin_layout')
@extends('partials/admin_header')
@extends('partials/admin_sidebar')
@extends('partials/admin_footer')

@section('body')
	<div class="admin_main_content">
		{{ $time }}
		{{ $mempeak }}
		<hr>
		<span style="color:blue">Импорт завершен, было добавлено {{ $added }} товаров</span>
		<hr>
		<span style="color:red">{{ $missed }} товаров не было добавлено. Ошибки:</span>
		{{ HTML::ul($errors, ['style' => 'color:red']) }}
		<hr>
		<span style="color:green">Уведомления:</span>
		{{ HTML::ul($messages, ['style' => 'color:green']) }}
	</div>
@stop