@section('header')
	{{--<div class="snow_container">--}}
	{{--<div id="snow"> --}}
	<header>
		<hr class="header_top_hr">
		<div class="container_zipo">
			<div class="header_right">	
				<div class="header_contacts">
					<p class="header_phone">тел. 8 (812) 987 22 06</p><br>
					<p class="header_phone">тел. 8 (812) 987 08 81</p>
				</div>	
				<a href="/" class="logo_header">
					{{ HTML::image("img/markup/logo.png", "logo", ['class'=>'logo_header']) }}
				</a>	
			</div>	
			<div class="header_description">
				<div class="call_to_skype">
					<p class="call_to_skype_p">Позвонить нам в</p>
					<div id="SkypeButton_Call_thefantom2_1">
						<script type="text/javascript">
						    Skype.ui({
						      "name": "call",
						      "element": "SkypeButton_Call_thefantom2_1",
						      "participants": ["zipobshepit"],
						      "imageSize": 24
						    });
						 </script>
					</div>
				</div>
				<h1 class="header_descriprion_heading">OOO "ЗИП Общепит"</h1><br>
				<p class="header_description_text">Кухонное оборудование запасные части<br>
				к оборудованию пищеблоков<br>для баров, кафе, ресторанов и столовых<br>  (предприятий общественного питания). <br>Срочный ремонт и техническое обслуживание. </p>
			</div>	
			<div class="header_reg_adn_log">
				@if (Auth::user()->check())
					<p class="user_email">Вы вошли как: </br> {{ Auth::user()->get()->email }}</p>
					{{ Form::open(['url'=>'/user_logout', 'method'=>'POST', 'class'=>'']) }}
						{{ Form::submit('Выйти', ['class'=>'btn btn-default btn_exit']) }}
					{{ Form::close() }}
				@else 
					<div class="btn-group btn-group-lg register" role="group" aria-label="reg">
						<button type="button" class="btn btn-default login_button mfp-zoom-out" data-effect="mfp-zoom-out">Войти</button>
						<a href="/registration" class="btn btn-default reg_button">Регистрация</a>
					</div>
					@if (Setting::getDiscount()>0)
						<div class="start_mes alert alert-info alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><i aria-hidden="true" class="fa fa-times close_message"></i></button>
								<p class="mes_text_num">-{{Setting::getDiscount()}}%</p>
							<p class="message_text start_text">при<br><a href="/registration" class="alert-link">регистрации</a></p>
						</div>
					@endif	
					<div class="header_login mfp-hide mfp-zoom-out" data-effect="mfp-zoom-out">
						{{ Form::open(['url'=>'/user_login', 'method'=>'POST', 'class'=>'login_form input-group']) }}
							<p class="login_form_title">Вход на сайт</p>
							<div>
								{{ Form::label('email', 'E-mail', ['class'=>'login_label_email']) }}
								{{ Form::email('email', null, ['class'=>'login_input', 'required', 'placeholder'=>"Ваш e-mail", 'class'=>'login_form_input form-control login_form_input_email']) }}
							</div>
							<div>
								{{ Form::label('password', 'Пароль', ['class'=>'login_label_password']) }}
								{{ Form::password('password', ['class'=>'login_input', 'required', 'placeholder'=>"Ваш пароль", 'class'=>'login_form_input form-control login_form_input_password']) }}
							</div>
							{{ Form::submit('Войти', ['class'=>'btn submit_field login_form_button']) }}
						{{ Form::close() }}
					</div>	
				@endif
				{{ Form::open(array('url' => "/search", 'method' => 'GET', 'class'=>'header_search')) }}
					{{ Form::text('query', null, ['placeholder'=>"Поиск по каталогу", 'class'=>'form-control input_search', 'id' =>'search']) }} 
				{{ Form::close() }}
			</div>
		</div>
		<div class="navbar_wraper">		
		    <nav class="navbar navbar-inverse nav_header">
				<ul class="nav navbar-nav">
					<li class="@if ($env == 'catalog' || $env == 'byproducer' || $env == 'search') active @endif"><a href="/">Каталог</a></li>
					<li class="@if ($env == 'price') active @endif"><a href="/price">Прайс-лист</a></li>
					<li class="@if ($env == 'delivery') active @endif"><a href="/delivery">Доставка</a></li>
					<li class="@if ($env == 'specials') active @endif"><a href="/specials">Специальные предложения</a></li>
					<li class="@if ($env == 'about') active @endif"><a href="/about">О нас</a></li>
					<li class="@if ($env == 'contacts') active @endif"><a href="/contacts">Контакты</a></li>
				</ul>
			</nav>
		</div>	
	</header>
{{--</div>	--}}
{{--</div>--}}
@stop