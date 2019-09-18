@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Заказы</div>
                    <div class="panel-body">        
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#all">Все</a></li>
                            <li><a data-toggle="tab" href="#expired">Просроченные</a></li>
                            <li><a data-toggle="tab" href="#current">Текущие</a></li>
                            <li><a data-toggle="tab" href="#new">Новые</a></li>
                            <li><a data-toggle="tab" href="#success">Выполненные</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="all" class="tab-pane fade in active">
                                @include('display.orders_table', ['title'=>'Все заказы', 'style'=>'default'])
                            </div>
                            <div id="expired" class="tab-pane fade out">
                                    @include('display.orders_table', ['title'=>'Просроченные заказы', 'style'=>'warning', 'queryParams'=>'expiredQueryParams'])
                            </div>
                            <div id="current" class="tab-pane fade out">
                                @include('display.orders_table', ['title'=>'Текущие заказы', 'style'=>'info', 'queryParams'=>'currentQueryParams'])
                            </div>
                            <div id="new" class="tab-pane fade out">
                                @include('display.orders_table', ['title'=>'Новые заказы', 'style'=>'primary', 'queryParams'=>'newQueryParams'])
                            </div>
                            <div id="success" class="tab-pane fade out">
                                @include('display.orders_table', ['title'=>'Выполненные заказы', 'style'=>'success', 'queryParams'=>'successQueryParams'])
                            </div>        
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection