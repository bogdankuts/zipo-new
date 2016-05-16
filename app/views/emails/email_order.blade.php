<div class="message">
	<p>На вашем ресурсе <a href="http://www.vsezip.ru" target="_blank">ЗИП общепит</a> была оставлена заявка на заказ товара!</p>
	<p>Номер заявки - {{$orderId}}</p>
</div>
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
		<td class="form-control">Наименование</td>
		<td class="form-control">цена</td>
		<td class="form-control">Кол-во</td>
		<td class="form-control">Сумма</td>
	</tr>
	<? $sum = 0; ?>
	@foreach($items as $item)
		<tr>
			<td class="form-control">{{$item->title}}</td>
			<td class="form-control">{{$item->price}}</td>
			<td class="form-control">{{$item->count}}</td>
			<td class="form-control">{{$item->price*$item->count}} руб.</td>
		</tr>
		<? $sum += $item->price*$item->count; ?>
	@endforeach
	<tr>
		<td class="main_label">Общая сумма:</td>
		<td class="change_input change_input_code form-control">{{$sum}} руб.</td>
	</tr>
	<tr>
		<td class="main_label">Комментарий:</td>
		<td class="change_input change_input_code form-control">{{$comment}}</td>
	</tr>
</table>
<p>Удачного дня!</p>