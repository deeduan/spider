<?php

$has = false;
for ($i = 1; $i < 2; $i++) {
    // baby+sleep+sound+machine
    $url = "https://www.amazon.com/s?k=kid+timer&page={$i}&ref=sr_pg_{$i}";

    var_dump($url);
    $str = file_get_contents($url);
    file_put_contents('./duan', $str);

    $pattern = '/<span data-component-type="s-search-results" class="rush-component s-latency-cf-section" data-component-id="19">(\s\S)<\/span>/';

    if (preg_match($pattern, $str, $matches)) {
        $has = $i;
        break;
    }

    var_dump($matches);
}


if (false !== $has) {
    var_dump($has);
} else {
    echo "前2页都找不到你的产品\n";
}