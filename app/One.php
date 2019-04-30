<?php

use QL\QueryList;

require_once '../vendor/autoload.php';

try {
    $url = 'https://www.amazon.com/s?k=baby+sleep+sound+machine&page=2&ref=sr_pg_2';
    $ql = QueryList::get($url);

    $rt = $ql->find('.s-result-item[data-asin=B07FFWGW2L]')->attr('data-index');
    var_dump($rt);
} catch (\Exception $e) {
    var_dump('网络超时\n');
}
