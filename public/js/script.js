jQuery(document).ready(function ($) {
    $('.widget_weather_ajax').each(function(index, widget){
        getWeather(widget);
    });

    function getWeather( widget ){
        var $widget = $(widget);
        var $content = $widget.find('.content');
        var config = $widget.data('config');
        var {point, ajaxTimeout} = config;

        if(typeof point['lat'] == "undefined" || typeof point['lng'] == "undefined"){
            console.log('Данные точки заданы неправильно: ' + point);
            return;
        }

        reloadWeather( $content, config );
        if(ajaxTimeout){
            setInterval(
                function(){ 
                    reloadWeather( $content, config );
                },
                ajaxTimeout*1000
            );
        }

    }

    function reloadWeather( $content, config ){
        var {point} = config;

        $content.html('');
        $content.addClass('fa fa-spinner fa-spin');
        $.ajax({
            url: '/api/weather/get',
            method: 'GET',
            dataType: 'JSON',
            data: {
                lat: point['lat'],
                lng: point['lng']
            },
            success: function(data){
                if(data.status == -1){
                    //
                }else{
                    $content.removeClass('fa fa-spinner fa-spin');            
                    if(data.status == 1){
                        $content.html(data.data.temp);
                    }else{
                        $content.html('Err');
                    }
                }
            },
            error: function(data){

            }
        });

    }
});

function editLinkFormatter( value ){
    return "<a href='/orders/" + value + "/edit'>" + value + "</a>";
}

function statusFormatter( value ){
    return "<span class='label label-" + value.style + "'>" + value.title + "</span>";
}

function detailFormatter( index, row ){
    return "<ul>" + $.map(row.products, function(product, i){
        return "<li>" + product.name + "</li>"
    }).join('') + "</ul>";
}

function responseHandler(res){
    return res['data'];
}

function queryParams(params, query = '') {
    return {
        page: params.offset / params.limit + 1,
        limit: params.limit,
        query: query
    };
}

function expiredQueryParams(params){
    return queryParams(params, 'expired');
}

function currentQueryParams(params){
    return queryParams(params, 'current');
}

function newQueryParams(params){
    return queryParams(params, 'new');
}

function successQueryParams(params){
    return queryParams(params, 'success');
}

function dateFormatter( value ){
    return value;
}