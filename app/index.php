<?php

use QL\QueryList;

require_once '../vendor/autoload.php';

try {
    $has = false;
    for ($i = 1; $i <= 20; $i++) {
        // baby+sleep+sound+machine
        // kid+timer
        $keywords = 'baby+sleep+sound+machine';
        $url = "https://www.amazon.com/s?k={$keywords}&page={$i}&ref=sr_pg_{$i}";
        var_dump($url);
        $rt = QueryList::get($url)->find('[data-asin=B07FFWGW2L]')->attr('*');

        if (!empty($rt)) {
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


