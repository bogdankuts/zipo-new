@extends('partials/admin_layout')
@extends('partials/admin_header')
@extends('partials/admin_sidebar')
@extends('partials/admin_footer')

@section('body')
    @include('partials/flash_messages')
    <div class="admin_main_content">
        <ul class="all_pdfs">
            @foreach ($admins as $admin)
                <li>
                    <a>
                        <i class="fa fa-pencil upd_pdf change_icon_pdf_{{ $admin->cred_id }}"></i>
                    </a>
                    {{ Form::open(array('url' => "/admin/delete_admin?cred_id=$admin->cred_id", 'method' => 'POST', 'class'=>'admin_del_pdf_form ')) }}
                    <i class="fa fa-times del_pdf"></i>
                    {{ Form::submit('Сохранить', ['class'=>'hidden']) }}
                    {{ Form::close() }}
                    <p>{{$admin->login}}</p>
                    <div class="admin_change_subcategory_div adm_upd_pdf_{{$admin->cred_id}} adm_pdf_change_pop_up mfp-hide mfp-zoom-out" data-effect="mfp-zoom-out">
                        {{ Form::model($admin, ['url'=>"admin/update_admin", 'method'=>'POST', 'class'=>'admin_add_pdf_form input-group']) }}
                        {{ Form::hidden('cred_id', $admin->cred_id) }}
                        <p class="admin_add_subcategory_title">Редактирование админа</p>
                        <div class="change_block admin_id_subcategory_div">
                            <p class="admin_uni_label admin_id_subcategory_title">ID админа</p>
                            <p class="admin_id_subcategory_id">{{$admin->cred_id}}</p>
                        </div>
                        <div class="change_block admin_select_category_div">
                            {{ Form::label('login', 'Login', ['class'=>'admin_uni_label admin_select_category_label']) }}
                            {{ Form::text('login', $admin->login, ['class'=>'form-control admin_select_category_select', 'required']) }}
                        </div>
                        <div class="change_block admin_select_title_div">
                            {{ Form::label('password', 'New password', ['class'=>'admin_uni_label admin_select_title_label']) }}
                            {{ Form::text('password', null, ['class'=>'form-control admin_select_title_text', 'required']) }}
                        </div>
                        <div class="change_block admin_select_title_div">
                            {{ Form::label('master', 'Master', ['class'=>'admin_uni_label good_label']) }}
                            {{ Form::checkbox('master',true, true, ['class'=>'form-control good_input']) }}
                        </div>
                        {{ Form::submit('Изменить', ['class'=>'btn admin_add_button admin_uni_button ']) }}
                        {{ Form::close() }}
                    </div> <!--admin_add_subcategory_div-->
                    <script>
                        // admin change subcategory
                        $('.change_icon_pdf_{{$admin->cred_id}}').magnificPopup({
                            items: {
                                src: '.adm_upd_pdf_{{$admin->cred_id}}', // CSS selector of an element on page that should be used as a popup
                                type: 'inline'
                            },
                        });
                    </script>
                </li>
            @endforeach
        </ul>
    </div>
@stop