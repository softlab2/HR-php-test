@if(session()->has('order_saved'))
<div class="alert alert-success alert-dismissible" role="alert">
    Заказ успешно сохранен.
</div>
@endif
<div class="panel panel-{{$style}}">
    <div class="panel-heading">{{$title}}</div>
    <table
        id="{{uniqid()}}"
        data-pagination="true"
        data-toggle="table"
        data-response-handler="responseHandler"
        data-side-pagination="server"
        data-query-params="{{$queryParams ?? 'queryParams'}}"
        data-detail-view="true"
        data-detail-formatter="detailFormatter"
        data-locale="ru_RU"
        data-url="{{route('orders.index')}}">
        
        <thead class="thead-dark">
            <tr>
                <th data-field="id" data-formatter="editLinkFormatter">ID</th>
                <th data-field="partner.name">Партнер</th>
                <th data-field="products" data-visible="false">Cостав заказа</th>
                <th data-field="total">Стоимость заказа</th>
                <th data-field="status" data-formatter="statusFormatter">Статус</th>
                <th data-field="delivery_dt" data-formatter="dateFormatter">Дата доставки</th>
            </tr>
        </thead>
    </table>    
</div>
