<?php

namespace App;

use QL\QueryList;

class Index
{
    public function __construct()
    {
        $this->autoload();
    }

    private function autoload()
    {
        require_once '../vendor/autoload.php';
    }

    /**
     * 采集百度列表
     */
    public function getData()
    {
        $data = QueryList::get('https://www.baidu.com/s?wd=QueryList')
            // 设置采集规则
            ->rules([
                'title'=>array('h3','text'),
                'link'=>array('h3>a','href')
            ])
            ->queryData();

        return $data;
    }

    public function getProductPosition($keywords = 'baby+sleep+sound+machine')
    {
        // 待采集的同一个网站的网页集合
        $urls = [
            $this->formatAmazonUrl($keywords, 2, 2)
        ];
        // 元数据采集规则
        $rules = [
            'sign' => ['.s-result-item', 'data-asin']
        ];
        // 切片选择器
        $range = '.s-result-list:eq(0)';

        // 由于采集的都是同一个网站的网页，所以采集规则是可以复用的
        $ql = QueryList::rules($rules)->range($range);

        foreach ($urls as  $url) {
            var_dump($url);
            $data = $ql->get($url)->query()->getData();
        }

        return $data;
    }

    /**
     * 格式化输出
     *
     * @param $keywords
     * @param $page
     * @param $ref_page
     * @return string
     */
    public function formatAmazonUrl($keywords, $page, $ref_page)
    {
        $base = "https://www.amazon.com/s?k=%s&page=%d&ref=sr_pg_%d";

        $out = sprintf($base, $keywords, $page, $ref_page);

        return $out;
    }


}

require_once '../vendor/autoload.php';

//$range = '.s-result-list';
$range = '.s-result-list>div';
$data = QueryList::get('https://www.amazon.com/s?k=baby+sleep+sound+machine&page=2&ref=sr_pg_2')
    // 设置采集规则
    ->rules([
        'sign' => ['.s-result-item', 'data-asin'],
        'sign_index' => ['.s-result-item', 'data-index']
    ])->range($range)
    ->queryData();

if (file_exists('./duan')) {
    unlink('./duan');
}

file_put_contents('./duan', json_encode($data));
