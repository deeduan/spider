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
    protected $naturalPosition = -1;

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
		'Cookie: sid="peRazBil/ugGvj3sGx+1kg==|e1FPNg5S+E9vzZQnFxTlnxCAqjpKst+iAdG3KLiF9EU="; session-id=147-7017642-9858907; ubid-main=133-4345625-3062038; x-wl-uid=1nPnAXxkfDtp1ZP5vEQmwCD980wlJ+irpeoIRwjUUMX2+3Kwe96Akz98EHsX2eRFt6Jqie5uTDBV1qQb3AFL8fetG1HOyaf+2fXWz4aRR/Kiojj4u9EIjj+5CudlwR7c15uLk8b/2gwU=; s_pers=%20s_fid%3D308488E7D9A67932-0B819A5271DDB5F1%7C1701665837362%3B%20s_dl%3D1%7C1543901237364%3B%20gpv_page%3DUS%253AAS%253ASP-overview2%7C1543901237366%3B%20s_ev15%3D%255B%255B%2527ELUSSP-images-na.ssl-images-amazon.com%2527%252C%25271543899437373%2527%255D%255D%7C1701665837373%3B; i18n-prefs=USD; s_nr=1553744019018-Repeat; s_vnum=1982041274907%26vn%3D7; s_dslv=1553744019020; x-amz-captcha-1=1556453977579675; x-amz-captcha-2=Uarn5Lx5vXUsCsOHvooJHw==; session-id-time=2082787201l; at-main=Atza|IwEBIGHR8nGvCXHv0wrZRIhcXeBkuNLs7Aoj8thanjI7qit0ZQS6FiY-xKZT2C18WSIv2mUyUBZazCPmSPNrHBlKNShRiSeB6vYJGrT1Tvx8W-vQxWy9lzs36DVie3GgjOZOCiwhLjnM1iHpnDWu769aR0lMSD4lmBCX-9aDRuS5VFHpuyKkdMviPdGV8BdePqCmnXotE39Z29ZvMdGET68CYABWGtuv-DEYtWNi7NosWdHmE1HBQs4edinqIGS3hD9acWN3pnvMSZaB6LN-o6bxwGvvk33yM-nkQrxx4L4JFt3LzM22s1XKTJ_QxYr8ITe9aByUy77HLsu5yXHvFaupBF_CbVrF0kcyWE9XmsJWJqpoDe9UvT22exwWLocTUBZ06G4-nDvSNdAE9SXgHltptoBMs3aKBjGihURFbSVvMPWhMA; sess-at-main="bmIzmRwfQoxC4WZLif7Nl9SrSvpwVqBFp+64Hyi/G48="; sst-main=Sst1|PQENlEH-azttRtVJDyjtewwWCxEua7SNmF_yK-amMBWLJk54KxJZGWPTcuibWN8pbUkG7UxHioba_16_hxd9rAokeNkSOUUtOw6bycIgaTQtjeuv1GuuviCDJQSwislxb6D1zBiJHCV9xmbvFK8pV1JTXGpRs39INmZSN4CuyasDT9GFTWXbjxHt7eJVzfnmEGVp2ydBHzv7j3u7QU-wRknP2Mp8nMWBpHERocv3SWQlabkoi9i0cLdAXobw1dvwalIYGh_zr7p7tTfmhtl4IeOY9Sr6dpmb0dIPiDY4UHa3XoR0oyBfGsa1KM11---8NU0kLYxYdX-UfPdiImO9UbNzBw; x-main="X0BsqL0YOmHRm7eX9LlRqckCDmlETSkG3pwmRrB0Tks@6hRPKxqqbQ1wPzyR5pVf"; session-token=O9LStX3i3Upi28g3M92ctEg0pT5zK5a1n0DZh/QgsULUDTkiSeZdyzNUoVKLCshgXm1BkCwno5uGJLssdPM602Ghu8LSSHpp7d6gcz+A/d2iJ+48yLOOQmbs+7mxlpDz0/8uy4vMoGLaTT18LOeLvxnIbxuC/OmwbHzZEC8O+eeXwkJd28TaJZoobyWo3GTBf+gqteiyfnmFNM8By0zy/4UUjluKYyxNecc/BOPShaIPdgmVFcrPxMXl75bZMTyi1NNg/2/sHDQYJDhSr4TORQ==; csm-hit=tb:VDDXZ4MFEW36QQ4D62WQ+s-8NVT9NKX7TRH1EFNEZMT|1556886874324&t:1556886874324&adb:adblk_no',
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
            CURLOPT_TIMEOUT         => 60,
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
        curl_setopt($this->curl, CURLOPT_URL, $url);
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

        var_dump(date("Y-m-d H:i:s", time()));

        $this->setUrlOptions($url);
        $response = curl_exec($this->curl);

       // file_put_contents("./res/res_{$page}.html", $response);
        var_dump(date("Y-m-d H:i:s", time()));

        $http_status = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
        var_dump("状态码:    {$http_status}\n");

        $err      = curl_error($this->curl);
        if ($err) {
			file_put_contents('./err.log', json_encode($err)."\n", FILE_APPEND);
           // throw new Exception('段狼 CURL ERR: '.$err);
        }

        // 获取抓取到的网页phpQuery对象
//        $this->phpQuery($response);

        // 获取所在位置
        $this->findPosition($asin, $response);

        // 1、自然排名
        if ($this->naturalRange === -1) {
            $this->naturalRangePage = $page;
            $this->naturalUrl = $url;
            $this->naturalRange = $this->naturalRange($page);
        }

        // 3、广告排名
        if ($this->adRange === -1) {
            $this->adRangePage = $page;
            $this->adUrl = $url;
            $this->adRange = $this->adRange($page);
        }

        $this->resetOptions();
        // 还需要继续执行
        return false;
    }

    /**
     * 重置curl选项
     */
    public function resetOptions()
    {
        curl_reset($this->curl);
        $this->setDefaultOptions();
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
     *    // $position = $this->pq->find($this->pattern)->attr('data-index');
     * @return int
     */
    public function findPosition($asin, $response)
    {
        // 1、获取索引
        // 2、检查所有是否含有广告标识
        // 3、含有 - 广告索引
        // 4、不含有 常规索引
		$pattern = '/data-asin="'.$asin.'" data-index="(\d+)"/';

		preg_match_all($pattern, $response, $matches);

        $match = $matches[1];
        if (empty($match)) {
            return false;
        }

        // 生成查询对象
        $this->phpQuery($response);
        $pattern = 'span.a-color-secondary';
        $rules = [
            'ad' => [$pattern, 'text']
        ];
        foreach ($match as $position) {
            // 检查当前位置是否含有广告标识
            $range = 'div[data-index="'.$position.'"]';
            $res = $this->pq->rules($rules)->range($range)->queryData();

            // 是广告索引
            if (!empty($res[0]['ad'])) {
                $this->position = $position;
            } else {
                $this->naturalPosition = $position;
            }
        }
    }

    /**
     * 获取自然排名
     *
     * @param $page
     * @return false|int|string
     */
    public function naturalRange($page)
    {
        $position = $this->naturalPosition;

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
        if ($this->naturalPosition === -1) {
            return -1;
        }

        return $this->naturalPosition + 1;
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

    public function __destruct()
    {
        // 写日志
        // var_dump("析构函数被调用\n");
        curl_close($this->curl);
    }

}
