<div class="panel panel-prymary">
    <div class="panel-heading">Товары</div>
    <table
        id="{{uniqid()}}"
        data-pagination="true"
        data-toggle="table"
        data-response-handler="responseHandler"
        data-side-pagination="server"
        data-query-params="productsQueryParams"
        data-locale="ru_RU"
        data-url="{{route('products.index')}}">
        
        <thead class="thead-dark">
            <tr>
                <th data-field="id">ID</th>
                <th data-field="name">Наименование</th>
                <th data-field="vendor.name">Поставщик</th>
                <th data-field="price">Цена</th>
            </tr>
        </thead>
    </table>    
</div>
