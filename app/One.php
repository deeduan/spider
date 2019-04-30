<?php

use QL\QueryList;

require_once '../vendor/autoload.php';

try {
    $has = false;
    for ($i = 1; $i <= 20; $i++) {
        // baby+sleep+sound+machine
        //
        $url = "https://www.amazon.com/s?k=kid+timer&page={$i}&ref=sr_pg_{$i}";
        var_dump($url);
        $ql = QueryList::get($url);

        $rt = $ql->find('.s-result-item[data-asin=B07FFWGW2L]')->attr('*');
        $text = $ql->find('.s-result-item[data-asin=B07FFWGW2L')->text();

        if (!empty($rt)) {
//            var_dump($text);
            var_dump($rt);
            $has = $i;
            break;
        } else {
            sleep(2);
        }
    }

    if (false !== $has) {
        var_dump($has);
    } else {
        echo "前20页都找不到你的产品\n";
    }


} catch (\Exception $e) {
    var_dump('网络超时\n');
}


