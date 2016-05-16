<p>Ваш заказ №{{$orderId}}</p>
<p>был принят и будет обработан нашими специалистами в кратчайшие сроки!</p>
<p>Проверте пожалуйста Ваши контактные данные. В случае ошибки, пожалуйста свяжитесь с нами.</p>
<table class="order_form_table">
	<tr>
		<td class="main_label">Имя: </td>
		<td class="change_input form-control">{{$name}}</td>
	</tr>
	<tr>
		<td class="main_label">Фамилия:</td>
		<td class="change_input form-control">{{$surname}}</td>
	</tr>
	<tr>
		<td class="main_label">Телефон:</td>
		<td class="change_input change_input_code form-control">{{$phone}}</td>
	</tr>
	<tr>
		<td class="main_label">Email:</td>
		<td class="change_input change_input_code form-control">{{$email}}</td>
	</tr>
	<tr>
		<td class="main_label">Компания:</td>
		<td class="change_input change_input_code form-control">{{$company}}</td>
	</tr>
	<tr>
		<td class="main_label">Форма собственности:</td>
		<td class="change_input change_input_code form-control">{{$form}}</td>
	</tr>
	<tr>
		<td class="main_label">Способ доставки:(код)</td>
		<td class="change_input change_input_code form-control">{{$delivery}}</td>
	</tr>
	<tr>
		<td class="main_label">Адрес</td>
		<td class="change_input change_input_code form-control">{{$address}}</td>
	</tr>
	<tr>
		<td class="main_label"><b><center>ТОВАРЫ</center></b></td>
	</tr>
	<tr>
		<td class="main_label">Наименование</td>
		<td class="main_label">цена</td>
		<td class="main_label">Кол-во</td>
		<td class="main_label">Сумма</td>
	</tr>
	<? $sum = 0; ?>
	@foreach($items as $item)
		<tr>
			<td class="">{{$item->title}}</td>
			<td class="">{{$item->price}}</td>
			<td class="">{{$item->count}}</td>
			<td class="">{{$item->price*$item->count}} руб.</td>
		</tr>
		<? $sum += $item->price*$item->count; ?>
	@endforeach
	<tr>
		<td class="main_label">Общая сумма:</td>
		<td class="">{{$sum}} руб.</td>
	</tr>
	<tr>
		<td class="main_label">Комментарий:</td>
		<td class="">{{$comment}}</td>
	</tr>
</table>

<p>С уважением,<br> администрация сайта <a href="http://www.vsezip.ru">Зип Общепит.</a></p>