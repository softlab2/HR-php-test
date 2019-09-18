<?php
// Статусы заказа - вынесены из кода
return [
    'not_set' => ['title'=>'Не определен', 'style'=>'default'],
    'order' => [
        \App\Order::ORDER_STATUS_NEW        => ['title'=>'Новый', 'style'=>'primary'],
        \App\Order::ORDER_STATUS_APPROVED   => ['title'=>'Подтвержден', 'style'=>'info'],
        \App\Order::ORDER_STATUS_CLOSED     => ['title'=>'Завершен', 'style'=>'success'],
    ]
];