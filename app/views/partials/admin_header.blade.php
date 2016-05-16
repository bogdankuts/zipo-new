@section('header') 
	<header>
		<div class="container_main container_admin_header">
			<div class="admin_to_site">
				<div class="btn-group admin_header_btn_group">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<a href="/" class="admin_header_link"><i class="fa fa-home"></i> Зип Общепит</a>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li>
							<a href="/" class="btn btn-exit btn_exit btn_link">Перейти на сайт</a>
						</li>
					</ul>
				</div>	
			</div>
			<div class="btn-group admin_header_btn_group admin_header_btn_group_r">
				<button type="button" class="btn btn-default dropdown-toggle admin_header_btn" data-toggle="dropdown" aria-expanded="false">
					<i class="fa fa-user fa_user"></i>Привет, {{Auth::admin()->get()->login}} <span class="caret"></span>
				</button>
				<ul class="dropdown-menu bigger" role="menu">
					<li>
						{{ Form::open(array('url' => "/admin/admin_logout", 'method' => 'POST')) }}
							{{ Form::submit('Выйти', ['class'=>'btn btn-exit btn_exit']) }}
						{{ Form::close() }}
					</li>
				</ul>
			</div>	
		</div>	
	</header>
@stop