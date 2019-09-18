@extends('layouts.app')
@section('content')
    <?php $status = $order->status(); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                <div class="panel-heading">@if(!empty($order))<span class='label label-{{$status['style']}}'>{{$status['title']}}</span> Редактирование заказа № <b>{{$order->id}}</b> @else Новый заказ @endif</div>
    
                    <div class="panel-body">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#data">Данные заказа</a></li>
                            <li><a data-toggle="tab" href="#products">Состав заказа</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="data" class="tab-pane fade in active">
                                <div class="panel">
                                    <div class="panel-body">
                                        <form class="form-horizontal" method="POST" action="">
                                            {{ csrf_field() }}
                    
                                            <div class="form-group{{ $errors->has('client_email') ? ' has-error' : '' }}">
                                                <label for="email" class="col-md-4 control-label">E-Mail клиента</label>
                    
                                                <div class="col-md-6">
                                                    
                                                <input id="email" type="email" class="form-control" name="client_email" value="{{ old('client_email', $order->client_email) }}" required autofocus>
                                                    @if ($errors->has('client_email'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('client_email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('partner_id') ? ' has-error' : '' }}">
                                                <label for="partner_id" class="col-md-4 control-label">Партнер</label>
                    
                                                <div class="col-md-6">
                                                    <select id="partner_id" class="form-control" name="partner_id" required>
                                                        @foreach (\App\Partner::orderBy('name')->get() as $partner)
                                                        <option value="{{$partner->id}}" @if(old('partner_id', $order->partner_id) == $partner->id)selected @endif>{{$partner->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('partner_id'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('partner_id') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                    
                                            <div class="form-group">
                                                    <label for="total" class="col-md-4 control-label">Статус заказа</label>
                        
                                                    <div class="col-md-6">
                                                        <select id="status" class="form-control" name="status" required>
                                                                @foreach (config('statuses.order') as $status_id=>$status)
                                                                <option value="{{$status_id}}" @if(old('status', $order->status) == $status_id)selected @endif>{{$status['title']}}</option>
                                                                @endforeach
                                                        </select>
                                                        @if ($errors->has('status'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('status') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                            </div>

                                            <div class="form-group">
                                                    <label for="total" class="col-md-4 control-label">Сумма заказа</label>
                        
                                                    <div class="col-md-6">
                                                        <p>{{$order->total()}}<p>
                                                    </div>
                                            </div>
                    
                                            <div class="form-group">
                                                <div class="col-md-8 col-md-offset-4">
                                                    <button type="submit" class="btn btn-primary">
                                                        Сохранить
                                                    </button>

                                                    <a class="btn btn-link" href="{{ route('orders') }}">
                                                        К списку заказов
                                                    </a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div id="products" class="tab-pane fade">
                                <div class="panel ">
                                    <div class="panel-body">
                                        <table
                                            data-toggle="table">
                                            <thead>
                                              <tr>
                                                <th>Наименоание</th>
                                                <th>Количество</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($order->products as $row)
                                                <tr>
                                                    <td class="col-md-10">{{$row->name}}</td>
                                                    <td>{{$row->order_product->quantity}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table> 
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection