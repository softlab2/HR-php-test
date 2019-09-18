<?php
namespace App\Http\Controllers\API;

use App\Order;
use App\Http\Resources\Order as OrderResource;
use App\Http\Resources\OrderCollection;
use Illuminate\Http\Request;

class OrderController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Размер страницы
        $limit = $request->get('limit', 10);
        // Тип запроса - поскольку есть несколько групп заказов, а пагинация и фильтр на сервере,
        // то можно сконфигурировать запросы и отправлять только название
        // В данном случае конфиг запросов хранится в config/tables.php
        // По идее можно не конфиг сделать, а колбэки и их вызывать, это гибче, но внедрения в код больше
        // Здесь не учтено, что еще может быть отправлена сортировка из таблицы пользователем,
        // тогда надо отменить дефолтную
        // Получим тип запроса
        $queryType = $request->get('query', '');
        if( $queryConfig = config("tables.orders.queries.{$queryType}", null) ){
            //Если такой есть, применим кофигурацию
            //Сортировка 
            $query = Order::when(!empty($queryConfig['order']), function($q)use($queryConfig){
                $field = $queryConfig['order'][0];
                $direction = $queryConfig['order'][1];
                $q->orderBy($field, $direction);
            })
            // Фильтры
            ->when(!empty($queryConfig['where']), function($q)use($queryConfig){
                foreach($queryConfig['where'] as $where){
                    $field = $where[0];
                    $condition = $where[1];
                    $value = $where[2];
                    $q->where( $field, $condition, $value);
                }
            })
            // Фильтры по текущей дате
            ->when(!empty($queryConfig['whereDate']), function($q)use($queryConfig){
                foreach($queryConfig['whereDate'] as $where){
                    $field = $where[0];
                    $date = $where[1];
                    $q->whereDate( $field, $date);
                }
            })
            // ->when(!empty($queryConfig['full_limit']), function($q)use($queryConfig){
            //     $q->limit(50);
            // })

            // Пагинация
            ->paginate($limit);

        }else{
            // Если запроса нет, просто применим пагинацию, текущая страница учтется фрэймворком
            $query = Order::paginate($limit);
        }
        return new OrderCollection( $query );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
