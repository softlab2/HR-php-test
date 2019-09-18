<?php

// Конфигуратор таблиц - остались только запросы
// Хотел столбцы, но проще сделать форматтеры на javascript, чем городить огород
return [
    'orders' => [
        'queries' => [
            'expired'=>[
                'order' => ['delivery_dt', 'desc'],
                'where' =>[
                    ['status', '=', \App\Order::ORDER_STATUS_APPROVED],
                    ['delivery_dt', '<', date('Y-m-d H:i:s', time())]
                ],
                'full_limit' => 50
            ],
            'current'=>[
                'order' => ['delivery_dt', 'asc'],
                'where' =>[
                    ['status', '=', \App\Order::ORDER_STATUS_APPROVED],
                    ['delivery_dt', '>', date('Y-m-d H:i:s', time())],
                    ['delivery_dt', '<', date('Y-m-d H:i:s', strtotime("+24 hours"))]
                ],
            ],
            'new'=>[
                'order' => ['delivery_dt', 'asc'],
                'where' =>[
                    ['status', '=', \App\Order::ORDER_STATUS_NEW],
                    ['delivery_dt', '>', date('Y-m-d H:i:s', time())]
                ],
                'full_limit' => 50
            ],
            'success'=>[
                'order' => ['delivery_dt', 'desc'],
                'where' =>[
                    ['status', '=', \App\Order::ORDER_STATUS_CLOSED],
                ],
                'whereDate' => [
//                    ['delivery_dt', date('Y-m-d) ]
                    ['delivery_dt', '2019-09-14' ]
                ],
                'full_limit' => 50
            ],
        ],
    ]
];