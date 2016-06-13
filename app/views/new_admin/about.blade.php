@extends('new_admin/admin_layout')
@extends('new_admin/partials/header')
@extends('new_admin/partials/drawer')
@extends('new_admin/partials/footer')

@section('body')
	@include('partials/flash_messages')
	<div class="new_admins_list mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col about">
		<h1>Подробности нового релиза</h1>
		<div class="to_clients mdl-card mdl-shadow--2dp">
			<div class="mdl-card__title">
				<h2 class="mdl-card__title-text">Обращение к Клиентам</h2>
			</div>
			<div class="mdl-card__supporting-text">
				<p>Уважаемые Клиенты!</p>
				<p>Мы приносим наши глубочайшие извинения за доставленные неудобства и растянутые до невозможности сроки.</p>
				<p>Мы рады сообщить, что на данный момент вся деятельность компании проходит в штатном режиме и в ближайшее время мы наверстаем упущенное.</p>
				<p>Мы благодарим Вас за понимание, терпение и поддержку.</p>
				<p>Спасибо что остаетесь с нами! Надеемся что сможем радовать Вас и дальше!</p>
				<div class="sub">
					<p class="subscript">С уважением,</p>
					<p class="subscript">CEO &lt;bzzz!&gt; web development studio,</p>
					<p class="subscript">Богдан Куц</p>
				</div>
			</div>
		</div>
		<div class="current_release mdl-shadow--2dp">
			<h4>В версии 2.0.5</h4>
			<p>Мы с радостью пердставляем Вам обновленный дизайн административной панели. Изменения коснулись практически всех аспектов работы с контентом и каталогом. Надеемся Вам понравиться!</p>
			<p>Ниже представлен список основных изменений и новых возможностей!</p>
			<ul>
				<li>Добавлена панель управления, с самыми основными данными по сайту!</li>
				<li>Добавлены блоки самых просматриваемых и самых продаваемых товаров!</li>
				<li>Добавлены блоки последних заказов и выполненых заказов!</li>
				<li>Добавлена возможность добавлять meta теги при создании товаров и статей!</li>
				<li>Добавлена возожность работы с заказами через админ панель!(emailы все еще будут приодить)!</li>
				<li>Добавлена возможность просматривать клиентов!</li>
				<li>Добавлена возможность просматривать зазказы в разрезе одного клиента!</li>
				<li>Добавлена возможность просматривать пользователей!</li>
				<li>Добавлена возможность добавлять и удалять администраторов!</li>
				<li>Добавлена корзина и оформление заказа!</li>
				<li>Добавлены уведомления о том, что произшло на сайте пока админ не заходил в админ панель!</li>
				<li>Изменен алгоритм работы с курсами валют!</li>
				<li>Изменена логика редактирвоания деталировок, теперь все работает быстрее!</li>
				<li>Исправлены мелкие баги и недочеты!</li>
			</ul>
		</div>
		<div class="next_release mdl-shadow--2dp">
			<h4>В следующей версии</h4>
			<p>Мы не собираемся остановливаться на этом и уже готовим для Вас следующий релиз.</p>
			<p>В рамках этого релиза мы можем предложить Вам следующие улучшения:</p>
			<ul>
				<li>Улучшеный алгоритм добавления производителей.</li>
				<li>Отслеживание товаров попавших в категорию "Другое".</li>
				<li>Улучшеный алгоритм добавления подкатегорий.</li>
				<li>Расширенная статистика по клиентам и пользователям.</li>
				<li>Интегрированная статистика из Google Analyics и Яндекс.Метрика.</li>
				<li>Улучшеная статистика по товарам.</li>
				<li>Выгрузка каталога в формате .csv.</li>
				<li>Выгрузка пользователей.</li>
				<li>Выгрузка клиентов.</li>
				<li>Отслеживание покупок со скидками.</li>
				<li>Сохранение курсов валют и отслеживание динамики цен.</li>
				<li>Статистика продаж в зазрезе категории, подкатегории, товара.</li>
				<li>Добавление заказов вручную.</li>
				<li>Расширенный функционал работы с заказами.</li>
				<li>И несколько приятных сюрпризов!</li>
			</ul>
		</div>
	</div>
@stop
