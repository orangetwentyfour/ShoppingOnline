<?php
/**
 * Created by PhpStorm.
 * User: duy21
 * Date: 11/28/2018
 * Time: 9:43 PM
 */
return [
    'PAGINATE' => [
        'PRODUCTS' => 10,
        'PRODUCTS_CLIENT' => 20,
        'CATEGORIES' => 5,
        'CATEGORIES_CLIENT' => 5,
        'INVOICES' => 10,
        'USERS' => 20
    ],
    'CART' => [
        'TOTAL_ITEMS' => 20,
        'STATUS' => [
            'PENDING' => 0,
            'ON_THE_WAY' => 1,
            'TRANSPORTED' => 2,
            'PAID' => 3,
            'CANCELED' => 4
        ],
    ],
    'USER' => [
        'MAX_INVOICES' => 5
    ],
    'PROFILE' => [
        'INFO' => 1,
        'INVOICES' => 2
    ],
    'STATUS' => [
        '0' => 'Đang xử lí',
        '1' => 'Đang giao',
        '2' => 'Đã giao',
        '3' => 'Đã nhận',
        '4' => 'Đã hủy'
    ],
    'RECOMMEND_PRODUCTS' => 5,
    'TOP_PRODUCTS' => 6,
    'HOME_PRODUCTS' => 7,
    'STATISTIC' => [
        'DAY' => 30,
        'MONTH' => 12,
        'YEAR' => 5
    ]
];
