@extends('partials/layout')
@extends('partials/header')
@extends('partials/footer')
@extends('partials/left_sidebar')
@extends('partials/right_sidebar')
@include('partials/initial_meta')

@section('body')
	<div class="main_content">
		<ol class="breadcrumb">
		  <li><a href="/">Главная</a></li>
		  <li class="active">Доставка</li>
		</ol>
		<h2 class="about_heading universal_heading">Доставка</h2>
		<hr class="main_hr">
		<div class="about_text_block">
			<b><p class="about_text">Доставка по России, Белоруссии ,Казахстан.</p></b>
			<b><p class="about_text">1. Выбор транспортной компании:</p></b>
			<p class="about_text">
				Доставка осуществляется  после 100%-й оплаты стоимости товара. 
				Все заботы по отправке товара к Вам мы берем на себя. Стоимость доставки Вы можете рассчитать самостоятельно, например, 
				на  сайтах компаний, с которыми мы работаем (кликнув по картинке ниже), либо запросить у менеджера.
			</p>
			<a href="http://www.edostavka.ru/calculator.html" class="delivery_outer_link" target="_blank">
				<img src="/img/markup/evrodostavka.png" alt="delivery_brand" class="delivery_pic">
			</a>
			<a href="http://www.dellin.ru" class="delivery_outer_link" target="_blank">
				<img src="/img/markup/dellin.png" alt="delivery_brand" class="delivery_pic">
			</a>
			<a href="http://emspost.ru/ru/" class="delivery_outer_link" target="_blank">
				<img src="/img/markup/ems.png" alt="delivery_brand" class="delivery_pic">
			</a>
			<a href="http://www.ponyexpress.ru/tariff.php" class="delivery_outer_link" target="_blank">
				<img src="/img/markup/pony.png" alt="delivery_brand" class="delivery_pic">
			</a>
			<a href="http://pecom.ru/ru/" class="delivery_outer_link" target="_blank">
				<img src="/img/markup/pek.png" alt="delivery_brand" class="delivery_pic">
			</a>
			
			<a href="http://www.dimex.ws/rus/rus/calc_expr.php?mode=2" class="delivery_outer_link dimex" target="_blank">
				<img src="/img/markup/dimex.png" alt="delivery_brand" class="delivery_pic">
			</a>
			<p class="about_text grey_and_small">Также Вы можете заказать доставку в любой другой транспортно-экспедиционной компании по Вашему выбору. </p>
			<p class="about_text">Оплата стоимости доставки большинства транспортных компаний - при получении груза.
				Исключение - компания EMS (оплата отправителем, соответственно, предоплата от получателя). 
				Полный комплект отгрузочных документов (счет, товарная накладная, счет-фактура)
				вкладывается нами внутрь упаковки.
			</p>
			<b><p class="about_text delivary_subheading_text">2.Срок отгрузки со склада.</p></b>
			<p class="about_text">Срок отгрузки со склада один рабочий день.</p>
			<p class="about_text">Если товар находится на основном складе компании.</p>
			<b><p class="about_text">3.Торговля со всеми регионами и городами России.</p></b>
			<p class="about_text">
				Мы осуществляем поставки  запасных частей и комплектующих
				к торгово-технологическому оборудованию для предприятий общественного питания
				и торговли в во все регионы и города России.
			</p>
			<p class="about_text delivary_subheading_text">В частности.</p>
			<ul class="delivery_regions_1">
				<li class="delivery_region">Александров (Владимирская область)</li>
				<li class="delivery_region">Анапа (Краснодарский край)</li>
				<li class="delivery_region">Арзамас (Нижегородская область)</li>
				<li class="delivery_region">Архангельск (Архангельская область)</li>
				<li class="delivery_region">Архипо-Осиповка (Краснодарский край)</li>
				<li class="delivery_region">Астрахань (Астраханская область)</li>
				<li class="delivery_region">Боровск (Калужская область)</li>
				<li class="delivery_region">Брянск (Брянская область)</li>
				<li class="delivery_region">Валдай (Новгородская область)</li>
				<li class="delivery_region">Великий Новгород (Новгородская область)</li>
				<li class="delivery_region">Великий Устюг (Вологодская область)</li>
				<li class="delivery_region">Владивосток (Приморский край)</li>
				<li class="delivery_region">Владимир (Владимирская область)</li>
				<li class="delivery_region">Волгоград (Волгоградская область)</li>
				<li class="delivery_region">Вологда (Вологодская область)</li>
				<li class="delivery_region">Воронеж (Воронежская область)</li>
				<li class="delivery_region">Выборг (Ленинградская область)</li>
				<li class="delivery_region">Вышний Волочек (Тверская область)</li>
				<li class="delivery_region">Вязьма (Смоленская область)</li>
				<li class="delivery_region">Гатчина (Ленинградская область)</li>
				<li class="delivery_region">Геленджик (Краснодарский край)</li>
				<li class="delivery_region">Городец (Нижегородская область)</li>
				<li class="delivery_region">Гороховец (Владимирская область)</li>
				<li class="delivery_region">Дмитров (Московская область)</li>
				<li class="delivery_region">Егорьевск (Московская область)</li>
				<li class="delivery_region">Ейск (Краснодарский край)</li>
				<li class="delivery_region">Екатеринбург (Свердловская область)</li>
				<li class="delivery_region">Елабуга (Республика Татарстан)</li>
				<li class="delivery_region">Елец (Липецкая область)</li>
				<li class="delivery_region">Железноводск (Ставропольский край)</li>
				<li class="delivery_region">Зарайск (Московская область)</li>
				<li class="delivery_region">Звенигород (Московская область)</li>
				<li class="delivery_region">Иваново (Ивановская область)</li>
				<li class="delivery_region">Ижевск (Республика Удмуртия)</li>
				<li class="delivery_region">Изборск (Псковская область)</li>
				<li class="delivery_region">Йошкар-Ола (Республика Марий Эл)</li>
				<li class="delivery_region">Кабардинка (Краснодарский край)</li>
				<li class="delivery_region">Казань (Республика Татарстан)</li>
				<li class="delivery_region">Калининград (Калининградская область)</li>
			</ul>
			<ul class="delivery_regions_2">
				<li class="delivery_region">Калуга (Калужская область)</li>
				<li class="delivery_region">Кашин (Тверская область)</li>
				<li class="delivery_region">Кемерово (Кемеровская область)</li>
				<li class="delivery_region">Кириллов (Вологодская область)</li>
				<li class="delivery_region">Киров (Кировская область)</li>
				<li class="delivery_region">Кисловодск (Ставропольский край)</li>
				<li class="delivery_region">Коломна (Московская область)</li>
				<li class="delivery_region">Кострома (Костромская область)</li>
				<li class="delivery_region">Красная поляна (Краснодарский край)</li>
				<li class="delivery_region">Краснодар (Краснодарский край)</li>
				<li class="delivery_region">Красноярск (Красноярский край)</li>
				<li class="delivery_region">Кунгур (Пермский край)</li>
				<li class="delivery_region">Курск (Курская область)</li>
				<li class="delivery_region">Лазаревское (Краснодарский край)</li>
				<li class="delivery_region">Липецк (Липецкая область)</li>
				<li class="delivery_region">Москва (Московская область)</li>
				<li class="delivery_region">Мурманск (Мурманская область)</li>
				<li class="delivery_region">Муром (Владимирская область)</li>
				<li class="delivery_region">Мышкин (Ярославская область)</li>
				<li class="delivery_region">Нижний Новгород (Нижегородская область)</li>
				<li class="delivery_region">Нижний Тагил (Свердловская область)</li>
				<li class="delivery_region">Новороссийск (Краснодарский край)</li>
				<li class="delivery_region">Новосибирск (Новосибирская область)</li>
				<li class="delivery_region">Омск (Омская область)</li>
				<li class="delivery_region">Орел (Орловская область)</li>
				<li class="delivery_region">Осташков (Тверская область)</li>
				<li class="delivery_region">Палех (Ивановская область)</li>
				<li class="delivery_region">Пенза (Пензенская область)</li>
				<li class="delivery_region">Переславль-Залесский (Ярославская область)</li>
				<li class="delivery_region">Пермь (Пермский край)</li>
				<li class="delivery_region">Петергоф (Ленинградская область)</li>
				<li class="delivery_region">Петрозаводск (Республика Карелия)</li>
				<li class="delivery_region">Плес (Ивановская область)</li>
				<li class="delivery_region">Покров (Владимирская область)</li>
				<li class="delivery_region">Приозерск (Ленинградская область)</li>
				<li class="delivery_region">Псков (Псковская область)</li>
				<li class="delivery_region">Пушкин (Ленинградская область)</li>
				<li class="delivery_region">Пушкинские горы (Псковская область)</li>
				<li class="delivery_region">Пятигорск (Ставропольский край)</li>
			</ul>
			<ul class="delivery_regions_3">
				<li class="delivery_region">Ростов Великий (Ярославская область)</li>
				<li class="delivery_region">Ростов-на-Дону (Ростовская область)</li>
				<li class="delivery_region">Рыбинск (Ярославская область)</li>
				<li class="delivery_region">Рязань (Рязанская область)</li>
				<li class="delivery_region">Самара (Самарская область)</li>
				<li class="delivery_region">Санкт-Петербург (Ленинградская область)</li>
				<li class="delivery_region">Саранск (Республика Мордовия)</li>
				<li class="delivery_region">Саратов (Саратовская область)</li>
				<li class="delivery_region">Сергиев Посад (Московская область)</li>
				<li class="delivery_region">Серпухов (Московская область)</li>
				<li class="delivery_region">Смоленск (Смоленская область)</li>
				<li class="delivery_region">Соловки (Архангельская область)</li>
				<li class="delivery_region">Сортавала (Республика Карелия)</li>
				<li class="delivery_region">Сочи (Краснодарский край)</li>
				<li class="delivery_region">Суздаль (Владимирская область)</li>
				<li class="delivery_region">Таганрог (Ростовская область)</li>
				<li class="delivery_region">Тамбов (Тамбовская область)</li>
				<li class="delivery_region">Таруса (Калужская область)</li>
				<li class="delivery_region">Тверь (Тверская область)</li>
				<li class="delivery_region">Тобольск (Тюменская область)</li>
				<li class="delivery_region">Тольятти (Самарская область)</li>
				<li class="delivery_region">Томск (Томская область)</li>
				<li class="delivery_region">Торжок (Тверская область)</li>
				<li class="delivery_region">Торопец (Тверская область)</li>
				<li class="delivery_region">Тотьма (Вологодская область)</li>
				<li class="delivery_region">Туапсе (Краснодарский край)</li>
				<li class="delivery_region">Тула (Тульская область)</li>
				<li class="delivery_region">Тюмень (Тюменская область)</li>
				<li class="delivery_region">Углич (Ярославская область)</li>
				<li class="delivery_region">Ульяновск (Ульяновская область)</li>
				<li class="delivery_region">Уфа (Республика Башкортостан)</li>
				<li class="delivery_region">Хоста (Краснодарский край)</li>
				<li class="delivery_region">Чебоксары (Республика Чувашия)</li>
				<li class="delivery_region">Челябинск (Челябинская область)</li>
				<li class="delivery_region">Череповец (Вологодская область)</li>
				<li class="delivery_region">Элиста (Республика Калмыкия)</li>
				<li class="delivery_region">Юрьев-Польский (Владимирская область)</li>
				<li class="delivery_region">Ярославль (Ярославская область)</li>
			</ul>
		</div>
	</div>
@stop