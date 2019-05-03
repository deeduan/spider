<?php

require_once './curl.php';
require_once './phpexcel.php';
require_once './index.php';

$pq = new UCurl();

// 要计算的所有文件

$files = HandleFile::files(__DIR__."/excel");


if (empty($files)) {
    echo "--------------------\n";
    echo "请先在excel文件夹下面放入目标文件~~ \n";
    echo "请先在excel文件夹下面放入目标文件~~ \n";
    echo "请先在excel文件夹下面放入目标文件~~ \n";
    echo "--------------------\n";
    exit(0);
}

// 存放文件的excel对象
$excels = [];

foreach ($files as $file_name) {
    $explode = explode('.', $file_name);
    $bak_file_name_array = explode(DIRECTORY_SEPARATOR, $explode[0]);
    $bak_file_name = array_pop($bak_file_name_array);
    $resultExcelDir = __DIR__.DIRECTORY_SEPARATOR.'resultExcel'.DIRECTORY_SEPARATOR;
    $save_file_name = $resultExcelDir.$bak_file_name."的副本".".".$explode[1];
    $excel = new UExcel($file_name);
    $excel->saveFileName = $save_file_name;
    $excels[$file_name] = $excel;
}



//$url = "https://www.amazon.com/s?k=sound+machine+for+sleeping&page=1&ref=sr_pg_1";
//$page = 1;

// 循环文件
foreach ($excels as $file_name => $excel) {
    // 读取asin
    $asin = $excel->asin();
    // 读取关键词,每个关键词循环20次
    $keywords = $excel->getKeyWords();

    // 过滤掉空关键词和空asin
    if (empty($keywords) || empty($keywords)) {
        echo "--------------------\n";
        echo "{$file_name} asin或者关键词为空~~ \n";
        echo "{$file_name} asin或者关键词为空~~ \n";
        echo "--------------------\n";
        continue;
    }

    // 循环关键词
    foreach ($keywords as $key => $keyword) {
        try {
            // 循环20此来执行
            for ($i = 1; $i < 21; $i++) {
                $keyword = str_replace(' ', '+', trim($keyword));
                $url = "https://www.amazon.com/s?k={$keyword}&page={$i}&ref=sr_pg_{$i}";
                $pq->init($asin, $i, $url);
            }

            // 虚拟测试
//            $response = file_get_contents('./amazon.html');
//            $pq->test($response);


            // 获取结果
            $res = $pq->getRange();

            // 获取关键字的对应数据
            $data['ad_range'][]      = $res['ad_range']['content'];
            $data['ad_range_page'][] = $res['ad_range']['url'];
            $data['na_range'][]      = $res['na_range']['content'];
            $data['na_range_page'][] = $res['na_range']['url'];

        } catch (Exception $e) {
            echo "--------------------\n";
            echo "计算失败,请联系段狼~~ \n";
            echo "计算失败,请联系段狼~~ \n";
            echo "计算失败,请联系段狼~~ \n";
            echo "--------------------\n";
        }
    }

    // 批量写入excel
    $end_line = $key + 1;
    $excel->setAdRange($data['ad_range']);
    $excel->setAdUrl($data['ad_range_page']);
    $excel->setNaturalRange($data['na_range']);
    $excel->setNaturalUrl($data['na_range_page']);

    // 保存下载excel
    $excel->saveExcel($excel->saveFileName);
}



