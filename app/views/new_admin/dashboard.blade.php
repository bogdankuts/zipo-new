@extends('new_admin/admin_layout')
@extends('new_admin/partials/header')
@extends('new_admin/partials/drawer')
@extends('new_admin/partials/footer')

@section('head_js')
	{{--<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>--}}
	{{--<script type="text/javascript">--}}
			{{--google.charts.load('current', {packages: ['corechart']});--}}
			{{--google.charts.setOnLoadCallback(drawChart);--}}
        {{--function drawChart() {--}}

            {{--var data = google.visualization.arrayToDataTable([--}}
                {{--['Группа', 'От общего'],--}}
                {{--['Без мета тегов',     {{$noMetaItems}}],--}}
                {{--['С мета тегами', {{$allItems - $noMetaItems}}]--}}
            {{--]);--}}
            {{--var data_articles = google.visualization.arrayToDataTable([--}}
                {{--['Группа', 'От общего'],--}}
                {{--['Без мета тегов',     {{$noMetaArticles}}],--}}
                {{--['С мета тегами', {{$allArticles - $noMetaArticles}}]--}}
            {{--]);--}}
            {{--var data_items_no_title = google.visualization.arrayToDataTable([--}}
                {{--['Группа', 'От общего'],--}}
                {{--['Без мета тегов',     {{$noTitleItems}}],--}}
                {{--['С мета тегами', {{$allItems - $noTitleItems}}]--}}
            {{--]);--}}
            {{--var data_items_no_description = google.visualization.arrayToDataTable([--}}
                {{--['Группа', 'От общего'],--}}
                {{--['Без мета тегов',     {{$noDescriptionItems}}],--}}
                {{--['С мета тегами', {{$allItems - $noDescriptionItems}}]--}}
            {{--]);--}}
            {{--var data_articles_no_title = google.visualization.arrayToDataTable([--}}
                {{--['Группа', 'От общего'],--}}
                {{--['Без мета тегов',     {{$noTitleArticles}}],--}}
                {{--['С мета тегами', {{$allArticles - $noTitleArticles}}]--}}
            {{--]);--}}
            {{--var data_articles_no_description = google.visualization.arrayToDataTable([--}}
                {{--['Группа', 'От общего'],--}}
                {{--['Без мета тегов',     {{$noDescriptionArticles}}],--}}
                {{--['С мета тегами', {{$allArticles - $noDescriptionArticles}}]--}}
            {{--]);--}}

            {{--var options = {--}}
                {{--pieHole: 0,--}}
                {{--pieSliceTextStyle: {--}}
                    {{--color: 'black'--}}
                {{--},--}}
                {{--legend: 'none',--}}
                {{--slices: {--}}
                    {{--0: { color: 'rgb(244,67,54)' },--}}
                    {{--1: { color: 'rgb(255,171,64)' }--}}
                {{--}--}}
            {{--};--}}

            {{--var chart = new google.visualization.PieChart(document.getElementById('donut_single'));--}}
            {{--chart.draw(data, options);--}}

            {{--var chart_items_no_title = new google.visualization.PieChart(document.getElementById('no_title'));--}}
            {{--chart_items_no_title.draw(data_items_no_title, options);--}}

            {{--var chart_items_no_description = new google.visualization.PieChart(document.getElementById('no_description'));--}}
            {{--chart_items_no_description.draw(data_items_no_description, options);--}}

            {{--var chart_articles_no_title = new google.visualization.PieChart(document.getElementById('articles_no_title'));--}}
            {{--chart_articles_no_title.draw(data_articles_no_title, options);--}}

            {{--var chart_articles_no_description = new google.visualization.PieChart(document.getElementById('articles_no_description'));--}}
            {{--chart_articles_no_description.draw(data_articles_no_description, options);--}}

            {{--var chart_articles = new google.visualization.PieChart(document.getElementById('donut_single_articles'));--}}
            {{--chart_articles.draw(data_articles, options);--}}



        {{--}--}}
    {{--</script>--}}
	{{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js') }}
	{{ HTML::script('js/charts.js') }}
	<script>
		//items
		var items = $("#itemBasicChart");
		var data = {
			labels: [
				"Без мета тегов",
				"С мета тегами"
			],
			datasets: [
				{
					data: [{{$noMetaItems}}, {{$allItems - $noMetaItems}}],
					backgroundColor: [
						"#F44336",
						"#FFAB40",
					],
					hoverBackgroundColor: [
						"#F44336",
						"#FFAB40",
					]
				}]
		};
		var options = {
			maintainAspectRatio: false,
			responsive: true
		};
		var itemsChart = new Chart(items, {
			type: 'doughnut',
			data: data,
			options: options,
		});

		//articles
		var articles = $("#articleBasicChart");
		var data_articles = {
			labels: [
				"Без мета тегов",
				"С мета тегами"
			],
			datasets: [
				{
					data: [{{$noMetaArticles}}, {{$allArticles - $noMetaArticles}}],
					backgroundColor: [
						"#F44336",
						"#FFAB40",
					],
					hoverBackgroundColor: [
						"#F44336",
						"#FFAB40",
					]
				}]
		};
		var articlesChart = new Chart(articles, {
			type: 'doughnut',
			data: data_articles,
			options: options,
		});

		//items_title
		var itemsTitle = $("#itemsTitleChart");
		var dataItemsTitle = {
			labels: [
				"Без мета тегов",
				"С мета тегами"
			],
			datasets: [
				{
					data: [{{$noTitleItems}}, {{$allItems - $noTitleItems}}],
					backgroundColor: [
						"#F44336",
						"#FFAB40",
					],
					hoverBackgroundColor: [
						"#F44336",
						"#FFAB40",
					]
				}]
		};
		var itemsTitleChart = new Chart(itemsTitle, {
			type: 'doughnut',
			data: dataItemsTitle,
			options: options
		});

		//items_description
		var itemsDescription = $("#itemsDescriptionChart");
		var dataItemsDescription = {
			labels: [
				"Без мета тегов",
				"С мета тегами"
			],
			datasets: [
				{
					data: [{{$noDescriptionItems}}, {{$allItems - $noDescriptionItems}}],
					backgroundColor: [
						"#F44336",
						"#FFAB40",
					],
					hoverBackgroundColor: [
						"#F44336",
						"#FFAB40",
					]
				}]
		};
		var itemsDescriptionChart = new Chart(itemsDescription, {
			type: 'doughnut',
			data: dataItemsDescription,
			options: options
		});

		//articles_title
		var articlesTitle = $("#articlesTitleChart");
		var dataArticlesTitle = {
			labels: [
				"Без мета тегов",
				"С мета тегами"
			],
			datasets: [
				{
					data: [{{$noTitleArticles}}, {{$allArticles - $noTitleArticles}}],
					backgroundColor: [
						"#F44336",
						"#FFAB40",
					],
					hoverBackgroundColor: [
						"#F44336",
						"#FFAB40",
					]
				}]
		};
		var articlesTitleChart = new Chart(articlesTitle, {
			type: 'doughnut',
			data: dataArticlesTitle,
			options: options
		});

		//items_description
		var articlesDescription = $("#articlesDescriptionChart");
		var dataArticlesDescription = {
			labels: [
				"Без мета тегов",
				"С мета тегами"
			],
			datasets: [
				{
					data: [{{$noDescriptionArticles}}, {{$allArticles - $noDescriptionArticles}}],
					backgroundColor: [
						"#F44336",
						"#FFAB40",
					],
					hoverBackgroundColor: [
						"#F44336",
						"#FFAB40",
					]
				}]
		};
		var articlesDescriptionChart = new Chart(articlesDescription, {
			type: 'doughnut',
			data: dataArticlesDescription,
			options: options
		});
	</script>
@stop
@section('body')
	@include('partials/flash_messages')
	@if($notifications['newAdmins'] > 0
        || $notifications['newClients'] > 0
        || $notifications['newOrders'] > 0
        || $notifications['newUsers'] > 0
        || $notifications['newArticles'] > 0
        || $notifications['newDiscount'] != ''
        )
        <div class="notifications mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
            <h4 class="mdl-typography--display-1 main_heading">Со времени вашего последнего входа произошло следующее</h4>
            @if($notifications['newAdmins'] > 0)
                <div class="one_notification" id="newAdmins">
                    <div class= "content">
                        <div class="">
                            <div class="mdl-badge" data-badge="{{$notifications['newAdmins']}}" id="new_admins">
                                <i class="material-icons notification_icon">person_add</i>
                            </div>
                        </div>
                        <div class="mdl-card__actions">
                            <a href="/admin/new-admins-after-last-visit/{{$lastVisit}}" target="_blank" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                                Подробнее
                            </a>
                        </div>
                        <div class="mdl-card__menu">
                            <button class="mdl-button mdl-js-button mdl-button--icon close_notification-admins">
                                <i class="material-icons">close</i>
                            </button>
                        </div>
                        <div class="mdl-tooltip" for="new_admins">
                            Новые админы
                        </div>
                    </div>
                </div>
            @endif
            @if($notifications['newClients'] > 0)
                <div class="one_notification" id="newClients">
                    <div class= "content">
                        <div class="">
                            <div class="mdl-badge" data-badge="{{$notifications['newClients']}}" id="new_clients">
                                <i class="material-icons notification_icon">person</i>
                            </div>
                        </div>
                        <div class="mdl-card__actions">
                            <a href="/admin/new-clients-after-last-visit/{{$lastVisit}}" target="_blank" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                                Подробнее
                            </a>
                        </div>
                        <div class="mdl-card__menu">
                            <button class="mdl-button mdl-js-button mdl-button--icon close_notification-clients">
                                <i class="material-icons">close</i>
                            </button>
                        </div>
                        <div class="mdl-tooltip" for="new_clients">
                            Новые Клиенты
                        </div>
                    </div>
                </div>
            @endif
            @if($notifications['newOrders'] > 0)
                <div class="one_notification" id="newOrders">
                    <div class= "content">
                        <div class="">
                            <div class="mdl-badge" data-badge="{{$notifications['newOrders']}}" id="new_orders">
                                <i class="material-icons notification_icon">folder_open</i>
                            </div>
                        </div>
                        <div class="mdl-card__actions">
                            <a href="/admin/new-orders-after-last-visit/{{$lastVisit}}" target="_blank" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                                Подробнее
                            </a>
                        </div>
                        <div class="mdl-card__menu">
                            <button class="mdl-button mdl-js-button mdl-button--icon close_notification-orders">
                                <i class="material-icons">close</i>
                            </button>
                        </div>
                        <div class="mdl-tooltip" for="new_orders">
                            Новые заказы
                        </div>
                    </div>
                </div>
            @endif
            @if($notifications['newUsers'] > 0)
                <div class="one_notification" id="newUsers">
                    <div class= "content">
                        <div class="">
                            <div class="mdl-badge" data-badge="{{$notifications['newUsers']}}" id="new_users">
                                <i class="material-icons notification_icon">account_box</i>
                            </div>
                        </div>
                        <div class="mdl-card__actions">
                            <a href="/admin/new-users-after-last-visit/{{$lastVisit}}" target="_blank" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                                Подробнее
                            </a>
                        </div>
                        <div class="mdl-card__menu">
                            <button class="mdl-button mdl-js-button mdl-button--icon close_notification-users">
                                <i class="material-icons">close</i>
                            </button>
                        </div>
                        <div class="mdl-tooltip" for="new_users">
                            Новые Пользователи
                        </div>
                    </div>
                </div>
            @endif
            @if($notifications['newArticles'] > 0)
                <div class="one_notification" id="newArticles">
                    <div class= "content">
                        <div class="">
                            <div class="mdl-badge" data-badge="{{$notifications['newArticles']}}" id="new_articles">
                                <i class="material-icons notification_icon">description</i>
                            </div>
                        </div>
                        <div class="mdl-card__actions">
                            <a href="/admin/new-articles-after-last-visit/{{$lastVisit}}" target="_blank" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                                Подробнее
                            </a>
                        </div>
                        <div class="mdl-card__menu">
                            <button class="mdl-button mdl-js-button mdl-button--icon close_notification-articles">
                                <i class="material-icons">close</i>
                            </button>
                        </div>
                        <div class="mdl-tooltip" for="new_articles">
                            Новые статьи
                        </div>
                    </div>
                </div>
            @endif
            @if($notifications['newDiscount'] != '')
                <div class="one_notification" id="newDiscount">
                    <div class= "content">
                        <div class="">
                            <div class="mdl-badge" data-badge="1" id="new_discount">
                                <i class="material-icons notification_icon">local_atm</i>
                            </div>
                        </div>
                        <p class="full_block">{{$notifications['newDiscount']}}</p>
                        <div class="mdl-card__menu">
                            <button class="mdl-button mdl-js-button mdl-button--icon close_notification-discount">
                                <i class="material-icons">close</i>
                            </button>
                        </div>
                        <div class="mdl-tooltip" for="new_discount">
                            Новая скидка
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @endif
    <div class="latest_orders mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--6-col">
        <h4 class="mdl-typography--display-1 main_heading">Последние заказы</h4>
        @foreach($recentOrders as $recentOrder)
            <div class="card-orders mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">Заказ № {{$recentOrder->order_id}}</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <table class="mdl-data-table mdl-js-data-table">
                        <tbody>
                        <tr>
                            <th class="mdl-data-table__cell--non-numeric">Клиент</th>
                            <th>{{$recentOrder->name}} {{$recentOrder->surname}}</th>
                        </tr>
                        <tr>
                            <td class="mdl-data-table__cell--non-numeric">Дата</td>
                            <td>{{$recentOrder->date}}</td>
                        </tr>
                        <tr>
                            <td class="mdl-data-table__cell--non-numeric">Стасус</td>
                            <td>{{$recentOrder->state_title}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <a href="/admin/detailed_order?order_id={{$recentOrder->order_id}}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                        Подробнее
                    </a>
                </div>
                <div class="mdl-card__menu">
                    <button id="{{$recentOrder->order_id}}-menu-trigger"
                            class="mdl-button mdl-js-button mdl-button--icon">
                        <i class="material-icons">more_vert</i>
                    </button>
                    <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                        for="{{$recentOrder->order_id}}-menu-trigger">
                        <li class="mdl-menu__item mark_order_done" data-id="{{$recentOrder->order_id}}">
                            <p>Отметить как выполненный</p>
						</li>
						<li class="mdl-menu__item delete_order" data-id="{{$recentOrder->order_id}}">
							<p>Удалить</p>
						</li>
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
    <div class="latest_orders mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--6-col">
        <h4 class="mdl-typography--display-1 main_heading">Последние выполненные заказы</h4>
        @foreach($recentDoneOrders as $recentDoneOrder)
            <div class="card-orders mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">Заказ № {{$recentDoneOrder->order_id}}</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <table class="mdl-data-table mdl-js-data-table">
                        <tbody>
                        <tr>
                            <th class="mdl-data-table__cell--non-numeric">Клиент</th>
                            <th>{{$recentDoneOrder->name}} {{$recentDoneOrder->surname}}</th>
                        </tr>
                        <tr>
                            <td class="mdl-data-table__cell--non-numeric">Дата</td>
                            <td>{{$recentDoneOrder->date}}</td>
                        </tr>
                        <tr>
                            <td class="mdl-data-table__cell--non-numeric">Стасус</td>
                            <td>{{$recentDoneOrder->state_title}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <a href="/admin/detailed_order?order_id={{$recentDoneOrder->order_id}}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                        Подробнее
                    </a>
                    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect delete_btn delete_order" data-id="{{$recentDoneOrder->order_id}}">
                        Удалить
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="most_viewed mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--6-col">
        <h4 class="mdl-typography--display-1 main_heading">Самые популярные товары</h4>
        <ul class="demo-list-control mdl-list">
            @foreach($mostViewedItems as $mostViewedItem)
                <li class="mdl-list__item">
                    <span class="mdl-list__item-primary-content">
                        {{$mostViewedItem->title}} ({{$mostViewedItem->visits}} посещения(ий))
                    </span>
                    <span class="mdl-list__item-secondary-action" id="switch_{{$mostViewedItem->item_id}}">
                        <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="list-switch-{{$mostViewedItem->item_id}}">
                            <input type="checkbox" id="list-switch-{{$mostViewedItem->item_id}}" data-id="{{$mostViewedItem->item_id}}"class="mdl-switch__input list_make_hit" @if($mostViewedItem->hit === 1) checked @endif/>
                        </label>
                    </span>
                    <div class="mdl-tooltip" for="switch_{{$mostViewedItem->item_id}}">
                        Сделать хитом<br>продаж
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="most_selling mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--6-col">
        <h4 class="mdl-typography--display-1 main_heading">Самые продаваемые товары</h4>
        <ul class="demo-list-control mdl-list">
            @foreach($mostSellingItems as $mostSellingItem)
                <li class="mdl-list__item">
                    <span class="mdl-list__item-primary-content">
                        {{$mostSellingItem->title}} ({{$mostSellingItem->sales}} единиц продано)
                    </span>
                    <span class="mdl-list__item-secondary-action" id="switch_{{$mostSellingItem->item_id}}">
                        <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="list-most-selling-switch-{{$mostSellingItem->item_id}}">
                            <input type="checkbox" id="list-most-selling-switch-{{$mostSellingItem->item_id}}" data-id="{{$mostSellingItem->item_id}}"class="mdl-switch__input list_make_hit" @if($mostSellingItem->hit === 1) checked @endif/>
                        </label>
                    </span>
                    <div class="mdl-tooltip" for="switch_{{$mostSellingItem->item_id}}">
                        Сделать хитом<br>продаж
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
	<div class="set_discount mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--4-col">
		<h4 class="mdl-typography--display-1 main_heading">Скидка для зарегистрированных пользователей</h4>
		{{ Form::open(array('url' => "/admin/set_discount?discount=$discount", 'method' => 'POST', 'class'=>'admin_discount_input')) }}
		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			{{ Form::label('discount', 'Дисконт', ['class'=>'mdl-textfield__label']) }}
			{{ Form::text('discount', $discount, ['class'=>'mdl-textfield__input', 'required', 'id' => 'discount']) }}
			{{ Form::hidden('changed_by', Auth::admin()->get()->cred_id) }}
		</div>
			{{ Form::submit('Изменить', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) }}
		{{ Form::close() }}
	</div>
	<div class="eur_rate mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--4-col">
		<h4 class="mdl-typography--display-1 main_heading">Текущий курс евро<br />на {{Carbon\Carbon::now()->format('d-m-Y')}}</h4>
		{{ Form::open(array('url' => "/admin/set_eur_rate", 'method' => 'POST', 'class'=>'admin_discount_input rate_input')) }}
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				{{ Form::label('rate', 'Курс', ['class'=>'mdl-textfield__label']) }}
				{{ Form::number('rate', $current_EUR_rate, ['class'=>'mdl-textfield__input', 'required', 'id' => 'rate']) }}
			</div>
			{{ Form::submit('Изменить', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) }}
		{{ Form::close() }}
	</div>
	<div class="eur_rate mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--4-col">
		<h4 class="mdl-typography--display-1 main_heading">Импорт</h4>
		{{ Form::open(['url'=>'/admin/import', 'files'=>true, 'method'=>'POST', 'class'=>'admin_panel_import']) }}
			{{ Form::file('excel', ['class'=>'admin_panel_input']) }}
			{{ Form::submit('Импортировать', ['class'=>'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent import_btn']) }}
		{{ Form::close() }}
	</div>
	@if($noMetaItems != 0 || $noMetaArticles != 0 )
		<div class="review mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
			<h4 class="mdl-typography--display-1 main_heading">Обзор товаров и новостей</h4>
			<div class="charts">
				<div class="items @if ($noMetaArticles = 0) only @endif">
					<h5 class="mdl-typography--title title">Товары</h5>
					<canvas id="itemBasicChart" width="400" height="400"></canvas>
					<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent stats_more" id="items_more_statistic">
						Подробнее
					</button>
				</div>
				<div class="articles @if ($noMetaItems = 0) only @endif">
					<h5 class="mdl-typography--title title">Новости</h5>
					<canvas id="articleBasicChart" width="400" height="400"></canvas>
					<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent stats_more" id="articles_more_statistic">
						Подробнее
					</button>
				</div>
			</div>
		</div>
		<div class="items_more_statistic_block mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
			<div class="charts">
				<div class="one_graph">
					<h5 class="mdl-typography--title title">Товары без "meta-title"</h5>
					<canvas id="itemsTitleChart" width="200" height="200"></canvas>
					<a href="/admin/no_title_items" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
						Посмотреть список
					</a>
				</div>
				<div class="one_graph">
					<h5 class="mdl-typography--title title">Товары без "meta-description"</h5>
					<canvas id="itemsDescriptionChart" width="200" height="200"></canvas>
					<a href="/admin/no_description_items" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
						Посмотреть список
					</a>
				</div>
			</div>
		</div>
		<div class="articles_more_statistic_block mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
			<div class="charts">
				<div class="one_graph">
					<h5 class="mdl-typography--title title">Новости без "meta-title"</h5>
					<canvas id="articlesTitleChart" width="200" height="200"></canvas>
					<a href="/admin/no_title_articles" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
						Посмотреть список
					</a>
				</div>
				<div class="one_graph">
					<h5 class="mdl-typography--title title">Новости без "meta-description"</h5>
					<canvas id="articlesDescriptionChart" width="200" height="200"></canvas>
					<a href="/admin/no_description_articles" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
						Посмотреть список
					</a>
				</div>
			</div>
		</div>
	@endif
@stop
@section('specific_page_js')
	{{ HTML::script('js/admin/orders.js') }}
@stop


