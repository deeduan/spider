<?php

use QL\QueryList;

class UCurl
{

    /**
     * curl 对象
     * @var null
     */
    protected $curl = null;

    /**
     * 查询正则
     * @var
     */
    protected $pattern;

    /**
     * 可复用的phpquery
     *
     * @var
     */
    protected $pq;

    /**
     * data-index 的值 -1是无效位
     *
     * @var int
     */
    protected $position = -1;

    /**
     * HEADER 头信息
     */
    const HEADER = [
        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3",
        "Accept-Language: zh-CN,zh;q=0.9",
        "Cache-Control: no-cache",
        "Connection: keep-alive",
        "Host: www.amazon.com",
        "Postman-Token: 990f621a-4641-444a-962d-eb759e1fda54,72b00486-9db0-4313-811f-c4c5e3785650",
        "User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36",
        "accept-encoding: gzip, deflate",
        "cache-control: no-cache"
    ];

    /**
     * COOKIE
     */
    const U_COOKIE = [
        'Cookie: sid="peRazBil/ugGvj3sGx+1kg==|e1FPNg5S+E9vzZQnFxTlnxCAqjpKst+iAdG3KLiF9EU="; session-id=147-7017642-9858907; ubid-main=133-4345625-3062038; x-wl-uid=1nPnAXxkfDtp1ZP5vEQmwCD980wlJ+irpeoIRwjUUMX2+3Kwe96Akz98EHsX2eRFt6Jqie5uTDBV1qQb3AFL8fetG1HOyaf+2fXWz4aRR/Kiojj4u9EIjj+5CudlwR7c15uLk8b/2gwU=; s_pers=%20s_fid%3D308488E7D9A67932-0B819A5271DDB5F1%7C1701665837362%3B%20s_dl%3D1%7C1543901237364%3B%20gpv_page%3DUS%253AAS%253ASP-overview2%7C1543901237366%3B%20s_ev15%3D%255B%255B%2527ELUSSP-images-na.ssl-images-amazon.com%2527%252C%25271543899437373%2527%255D%255D%7C1701665837373%3B; i18n-prefs=USD; s_nr=1553744019018-Repeat; s_vnum=1982041274907%26vn%3D7; s_dslv=1553744019020; x-amz-captcha-1=1556453977579675; x-amz-captcha-2=Uarn5Lx5vXUsCsOHvooJHw==; session-id-time=2082787201l; at-main=Atza|IwEBIAWZI-HxcDEZPItEFJQ85igABohO8N1dPwsnAqbAuFazWy6wwK4Yna5SuUdiSpB0n0miuHsUSBrtuXss05_HPmaY5LlGUfL_vz0uWJdPZsCn6MNKisgv7aMfadupVNPRU1u1as6VHlybt_sc3xVoM2OlxypTSfvSjQ3kNh9lNfHcHyAJIKabsuyBskUZNm8ncXnyfG1JE5A3LUrDY7BtGeEKlTwY6PtNgoFhq4yz330Fk-0JqFo0AYV5V6G4N1eDA8poFYUc-4caDNgYk_MN3kFjMln5lXorsGAQQt5XJf90C0-Faase9p5lUjW-PlCVmdAvmrfdFPz5nnBYx-MhHHTs9LWSA1JPh8voM4Mzm548TwAiGxmR9QGB5F5cUJ88WQC_gLS5xrfYOV6VZaoKqz9_eUjidjf1n_xxLEzx8_YGcg; sess-at-main="Hx39TDm+5Qc1J0mAUTnFqLiS3wbTDR9oM1W78kA3BWA="; sst-main=Sst1|PQGGHhDSFGYHu3le48QwjRfAC9BbYfIchrU7Jbgz1MzKS72HBNSgkgFlgvWPWWPoE91STka3rpXB4MABvQvUf7CyKOsBblF6D2Ryz5JKP3fVTEQ0o1WlLIj8Kvcl6lzE69lvfev5Fj89IBWPY4nJQ5F3ZruOrj1D5s8xGNWYvWjZhZat1kvEmHo9J7YJJJvBWxb1X_HQIxijvruOhGNCXB_NQRlS5wxdkRIFmDC4a6kT6DR8xfQEEd_dpBgCM4jHbSqw1u_BhtQPdeaBuyHqRhZ0HSdg8_N0WP0COPUdcstz3niEgHbQ48LdiFBJOcfmr7qlIccgavs40HT6Oe9_3r7FsA; x-main="gyYy2xi4CiqeiI8OjRf3prCwtCOW39jo2NEN99sw2@RKsR7JI0KXBD@0lwDfsgBC"; session-token=KORWg6nRp6QsdjZ5/g2lzLHhm8syHPcZ+IZjNjiRVhWUAlOhkcUMsQ+LnoQDGragjqXKPsR8ByzB/HSIFf9euG7eq2e4sabGXD0sf0WjahdHqX774ux9VA1yfVZJ3B6OmDk3GgvcbSsq/AWwFH2ndZYm0X6EprNrHtFqL7MjhQrSxYUsYSqK8WarcbYbmeovCoyWcq62mHcn3yYf0vENDB3SaNXktbmdNRGpyR/MH1gbGE0hLSR8/sKxeVEfLbC41b+io8HIdZGs3w18u3gSgQ==; skin=noskin; csm-hit=tb:1BKFH2GGPH64P7BTEGQ6+s-CE0QBWRFFFEXMT23RPY6|1556772172495&t:1556772172495&adb:adblk_no'
    ];

    /**
     * 第一页广告算法排位
     */
    const PAGE_ONE_AD = [
        0,1,18,19,20,21,54,55,56,57,58,59
    ];

    /**
     * 其他页广告算法排位
     */
    const PAGE_ANOTHER_AD = [0,1,2,3,20,21,22,23,56,57,58,59];

    /**
     * 自然排名
     *
     * @var int
     */
    public $naturalRange = -1;
    public $naturalRangePage = -1;
    public $naturalUrl = '';

    /**
     * 常规排名
     *
     * @var int
     */
    public $normalRange  = -1;
    public $normalRangePage = -1;

    /**
     * 广告排名
     *
     * @var int
     */
    public $adRange      = -1;
    public $adRangePage  = -1;
    public $adUrl  = '';

    /**
     * 初始化时区以及curl
     *
     * UCurl constructor.
     */
    public function __construct()
    {
        // 1、设置时区为洛杉矶时区
        ini_set('date.timezone', 'America/Los_Angeles');
        require_once '../vendor/autoload.php';
        $this->curl = curl_init();
        $this->setDefaultOptions();
    }

    /**
     * 设置默认选项
     *
     * @param array $options
     */
    public function setDefaultOptions($options = [])
    {
        $options = array_merge(static::HEADER, static::U_COOKIE, $options);
        $header = [
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_ENCODING        => "",
            CURLOPT_MAXREDIRS       => 10,
            CURLOPT_TIMEOUT         => 30,
            CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST   => "GET",
            CURLOPT_POSTFIELDS      => "",
            CURLOPT_HTTPHEADER      => $options,
        ];
        curl_setopt_array($this->curl, $header);
    }

    /**
     * 设置url 选项
     *
     * @param string $url
     */
    public function setUrlOptions($url = '')
    {
        $header = [
            CURLOPT_URL => $url,
        ];

        curl_setopt_array($this->curl, $header);
    }

    /**
     * @param $asin
     * @param int $page
     * @param string $url
     * @return bool
     * @throws Exception
     */
    public function init($asin, $page = 1, $url = '')
    {
        // 2项都已经找到,终结函数执行
        if ($this->naturalRange !== -1 && $this->adRange !== -1) {
            return true;
        }

        // 生成查询正则
        $this->asinPattern($asin);

        // 抓取网页 - 失败抛出异常
        $this->setUrlOptions($url);
        $response = curl_exec($this->curl);
        $err      = curl_error($this->curl);
        curl_close($this->curl);
        if ($err) {
            throw new Exception('CURL ERR: '.$err);
        }

        // 获取抓取到的网页phpQuery对象
        $this->phpQuery($response);

        // 获取所在位置
        $this->position = $this->findPosition();

        // 1、自然排名
        if ($this->naturalRange === -1) {
            $this->naturalRangePage = $page;
            $this->naturalUrl = $url;
            $this->naturalRange = $this->naturalRange($page);
        }
        // 2、常规排名
        if ($this->normalRange === -1) {
            $this->normalRangePage = $page;
            $this->normalRange = $this->normalRange();
        }
        // 3、广告排名
        if ($this->adRange === -1) {
            $this->adRangePage = $page;
            $this->adUrl = $url;
            $this->adRange = $this->adRange($page);
        }

        // 还需要继续执行
        return false;
    }

    /**
     * 获取测试结果
     *
     * @param $response
     */
    public function test($response)
    {
        $this->asinPattern('B07FFWGW2L');

        // 获取抓取到的网页phpQuery对象
        $this->phpQuery($response);

        // 获取所在位置
        $this->position = $this->findPosition();

        // 1、自然排名
        if ($this->naturalRange === -1) {
            $this->naturalRangePage = 1;
            $this->naturalUrl = "https://www.amazon.com/s?k=sound+machine+for+sleeping&page=1&ref=sr_pg_1";
            $this->naturalRange = $this->naturalRange(1);
        }
        // 2、常规排名
        if ($this->normalRange === -1) {
            $this->normalRangePage = 1;
            $this->normalRange = $this->normalRange();
        }
        // 3、广告排名
        if ($this->adRange === -1) {
            $this->adRangePage = 1;
            $this->adUrl = "https://www.amazon.com/s?k=sound+machine+for+sleeping&page=1&ref=sr_pg_1";
            $this->adRange = $this->adRange(1);
        }
    }

    /**
     * 生成pq
     * @param $html
     */
    public function phpQuery($html)
    {
        $this->pq = QueryList::html($html);
    }

    /**
     * 获取asin正则
     *
     * @param $asin
     */
    public function asinPattern($asin)
    {
        $this->pattern = "[data-asin={$asin}]";
    }

    /**
     * 获取位置
     *
     * @return int
     */
    public function findPosition()
    {
        $position = $this->pq->find($this->pattern)->attr('data-index');

        if (empty($position) && $position != 0) {
            return -1;
        }

        return intval($position);
    }

    /**
     * 获取自然排名
     *
     * @param $page
     * @return false|int|string
     */
    public function naturalRange($page)
    {
        $position = $this->position;

        $data = [];
        for ($i = 0; $i < 60; $i++) {
            $data[] = $i;
        }

        $range = $page === 1 ? static::PAGE_ONE_AD : static::PAGE_ANOTHER_AD;
        $natural_range = array_values(array_diff($data, $range));

        $res = array_search(intval($position), $natural_range);

        if (false !== $res) {
            return $res + 1;
        }

        return -1;
    }

    /**
     * 广告排名
     *
     * @param $page
     * @return false|int|string
     */
    public function adRange($page)
    {
        $position = $this->position;

        $range = $page === 1 ? static::PAGE_ONE_AD : static::PAGE_ANOTHER_AD;

        $res = array_search($position, $range);

        if (false !== $res) {
            return $res + 1;
        }

        return -1;
    }

    /**
     * 常规排名
     *
     * @return int
     */
    public function normalRange()
    {
        if ($this->position === -1) {
            return -1;
        }

        return $this->position + 1;
    }


    /**
     * 获取排名
     *
     * @return array
     */
    public function getRange()
    {
        $data = [
            'ad_range' => [
                'url' => $this->adUrl
            ],
            'na_range' => [
                'url' => $this->naturalUrl
            ]
        ];

        if ($this->adRange === -1) {
            $data['ad_range']['content'] = '无';
            $data['ad_range']['url'] = '无';
        } else {
            $data['ad_range']['content'] = "P{$this->adRangePage}N{$this->adRange}";
        }

        if ($this->naturalRange === -1) {
            $data['na_range']['content'] = '无';
            $data['na_range']['url'] = '无';
        } else {
            $data['na_range']['content'] = "P{$this->naturalRangePage}N{$this->naturalRange}";
        }

        return $data;
    }



}
