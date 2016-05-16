@extends('new_admin/admin_layout')
@extends('new_admin/partials/header')
@extends('new_admin/partials/drawer')
@extends('new_admin/partials/footer')

@section('body')
    <div class="new_admins_list mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
        @foreach($newClients as $client)
            <div class="admin-card mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">Клиент</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <table class="mdl-data-table mdl-js-data-table">
                        <tbody>
                        <tr>
                            <th class="mdl-data-table__cell--non-numeric">ФИО</th>
                            <th>{{$client->name}} {{$client->surname}}</th>
                        </tr>
                        <tr>
                            <td class="mdl-data-table__cell--non-numeric">Дата первого заказа</td>
                            <td>{{$client->added_at}}</td>
                        </tr>
                        <tr>
                            <td class="mdl-data-table__cell--non-numeric">Телефон</td>
                            <td>{{$client->phone}}</td>
                        </tr>
                        <tr>
                            <td class="mdl-data-table__cell--non-numeric">Email</td>
                            <td>{{$client->email}}</td>
                        </tr>
                        <tr>
                            <td class="mdl-data-table__cell--non-numeric">Компания</td>
                            <td>
                                @if( $client->company != '')
                                    {{$client->company}}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                        <tr>
                            <td class="mdl-data-table__cell--non-numeric">Форма собственности</td>
                            <td>
                                @if ($client->form_of_business === 'jura')
                                    Юридическое лицо
                                @else
                                    Физическое лицо
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>

@stop
