<div class="items_sort_div">	
	<p class="items_sort_by">Сортировать по: </p>

	<?php $q = http_build_query(Input::except(['page', 'order', 'sort'])); ?>
	<select name="items_sort" id="items_sort" class="form-control items_sort_c">
		<option data-link="{{URL::current().'?'.$q.'&sort=visits&order=desc' }}">
			популярности(&#8595;)
		</option>
		<option data-link="{{URL::current().'?'.$q.'&sort=visits&order=asc' }}">
			популярности(&#8593;)
		</option>
		<option data-link="{{URL::current().'?'.$q.'&sort=title&order=asc' }}">
			имени(а-я)
		</option>
		<option data-link="{{URL::current().'?'.$q.'&sort=title&order=desc' }}">
			имени(я-а)
		</option>
		<option data-link="{{URL::current().'?'.$q.'&sort=price&order=asc' }}">
			цене($-$$$)
		</option>
		<option data-link="{{URL::current().'?'.$q.'&sort=price&order=desc' }}">
			цене($$$-$)
		</option>
	</select>
</div>