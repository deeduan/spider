<?php

use QL\QueryList;

require_once '../vendor/autoload.php';

// 查找自然排名 + 广告排名
try {
    $html = file_get_contents('./amazon.html');
    $rt = QueryList::html($html)->find('[data-asin=B07FFWGW2L]')->attr('data-index');
    $res = $rt + 1;
    echo "搜索到的下标{$rt}\n";
    echo "自然排名加广告排名{$res}\n";
} catch (\Exception $e) {
    var_dump('网络超时\n');
}



// 第一页索引下标  0 1         18 19 20 21   54 55 56 57 58 59 是广告位置 总计12个广告位
// 第二页索引下标  0 1 2 3     20 21 22 23   56 57 58 59  是广告位 总计12个广告位
// 第n页索引下标   0 1 2 3     20 21 22 23   56 57 58 59  是广告位 总计12个广告位


// 第一页的广告排名下标
$range_page_one = [0,1,18,19,20,21,54,55,56,57,58,59];
// 其他页的广告排名下标
$range_page_another = [0,1,2,3,20,21,22,23,56,57,58,59];

$range = $range_page_another;

// 查找广告排名
try{
    $page_index = 1;
    $html = file_get_contents('./amazon.html');
    $rt = QueryList::html($html)->find('[data-asin=B07FFWGW2L]')->attr('data-index');

    // $rt 返回的是下标30 那么实际上是第三十一名

    // 如果是第一页
    if ($page_index === 1) {
        $range = $range_page_one;
    }

    $res = array_search($rt, $range);

    if ($res !== false) {
        $rank = $res + 1;
        echo "广告排名是: ".$rank."\n";
    } else {
        echo "本业无广告排名\n";
    }
} catch (\Exception $e) {
    var_dump('网络超时\n');
}


// 查找自然排名

for ($i = 0; $i < 60; $i++) {
    $data[] = $i;
}

// 计算第一页的差集吧
// @todo 根据页码计算差集
$natural_range = array_values(array_diff($data, $range_page_one));

//var_dump($natural_range);

// 去搜索
$res = array_search(30, $natural_range);

if ($res !== false) {
    $rank = $res + 1;
    echo "自然排名: ".$rank."\n";
} else {
    echo "本业无自然排名\n";
}
