<?php

$response = file_get_contents("./amazon.html", 'r');


echo $response;die;
$asin = "B07FFWGW2L";
$pattern = '/data-asin="'.$asin.'" data-index="(\d+)"/';

preg_match_all($pattern, $response, $matches);

var_dump($matches);

echo 567;die;

ini_set('date.timezone','America/Los_Angeles');
//     CURLOPT_URL => "https://www.amazon.com/s?k=alarm+clock+cell+phone+charger&page=2&ref=sr_pg_2",
$curl = curl_init();

// $url = "https://www.amazon.com/s?k=led+alarm+clock&page=1&ref=sr_pg_1";
$url = "https://www.amazon.com/s?k=sound+machine+for+sleeping&page=1&ref=sr_pg_1";

curl_setopt_array($curl, array(

    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_POSTFIELDS => "",
    CURLOPT_HTTPHEADER => array(
        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3",
        "Accept-Language: zh-CN,zh;q=0.9",
        "Cache-Control: no-cache",
        "Connection: keep-alive",
        'Cookie: sid="peRazBil/ugGvj3sGx+1kg==|e1FPNg5S+E9vzZQnFxTlnxCAqjpKst+iAdG3KLiF9EU="; session-id=147-7017642-9858907; ubid-main=133-4345625-3062038; x-wl-uid=1nPnAXxkfDtp1ZP5vEQmwCD980wlJ+irpeoIRwjUUMX2+3Kwe96Akz98EHsX2eRFt6Jqie5uTDBV1qQb3AFL8fetG1HOyaf+2fXWz4aRR/Kiojj4u9EIjj+5CudlwR7c15uLk8b/2gwU=; s_pers=%20s_fid%3D308488E7D9A67932-0B819A5271DDB5F1%7C1701665837362%3B%20s_dl%3D1%7C1543901237364%3B%20gpv_page%3DUS%253AAS%253ASP-overview2%7C1543901237366%3B%20s_ev15%3D%255B%255B%2527ELUSSP-images-na.ssl-images-amazon.com%2527%252C%25271543899437373%2527%255D%255D%7C1701665837373%3B; i18n-prefs=USD; s_nr=1553744019018-Repeat; s_vnum=1982041274907%26vn%3D7; s_dslv=1553744019020; x-amz-captcha-1=1556453977579675; x-amz-captcha-2=Uarn5Lx5vXUsCsOHvooJHw==; session-id-time=2082787201l; at-main=Atza|IwEBIAWZI-HxcDEZPItEFJQ85igABohO8N1dPwsnAqbAuFazWy6wwK4Yna5SuUdiSpB0n0miuHsUSBrtuXss05_HPmaY5LlGUfL_vz0uWJdPZsCn6MNKisgv7aMfadupVNPRU1u1as6VHlybt_sc3xVoM2OlxypTSfvSjQ3kNh9lNfHcHyAJIKabsuyBskUZNm8ncXnyfG1JE5A3LUrDY7BtGeEKlTwY6PtNgoFhq4yz330Fk-0JqFo0AYV5V6G4N1eDA8poFYUc-4caDNgYk_MN3kFjMln5lXorsGAQQt5XJf90C0-Faase9p5lUjW-PlCVmdAvmrfdFPz5nnBYx-MhHHTs9LWSA1JPh8voM4Mzm548TwAiGxmR9QGB5F5cUJ88WQC_gLS5xrfYOV6VZaoKqz9_eUjidjf1n_xxLEzx8_YGcg; sess-at-main="Hx39TDm+5Qc1J0mAUTnFqLiS3wbTDR9oM1W78kA3BWA="; sst-main=Sst1|PQGGHhDSFGYHu3le48QwjRfAC9BbYfIchrU7Jbgz1MzKS72HBNSgkgFlgvWPWWPoE91STka3rpXB4MABvQvUf7CyKOsBblF6D2Ryz5JKP3fVTEQ0o1WlLIj8Kvcl6lzE69lvfev5Fj89IBWPY4nJQ5F3ZruOrj1D5s8xGNWYvWjZhZat1kvEmHo9J7YJJJvBWxb1X_HQIxijvruOhGNCXB_NQRlS5wxdkRIFmDC4a6kT6DR8xfQEEd_dpBgCM4jHbSqw1u_BhtQPdeaBuyHqRhZ0HSdg8_N0WP0COPUdcstz3niEgHbQ48LdiFBJOcfmr7qlIccgavs40HT6Oe9_3r7FsA; x-main="gyYy2xi4CiqeiI8OjRf3prCwtCOW39jo2NEN99sw2@RKsR7JI0KXBD@0lwDfsgBC"; session-token=KORWg6nRp6QsdjZ5/g2lzLHhm8syHPcZ+IZjNjiRVhWUAlOhkcUMsQ+LnoQDGragjqXKPsR8ByzB/HSIFf9euG7eq2e4sabGXD0sf0WjahdHqX774ux9VA1yfVZJ3B6OmDk3GgvcbSsq/AWwFH2ndZYm0X6EprNrHtFqL7MjhQrSxYUsYSqK8WarcbYbmeovCoyWcq62mHcn3yYf0vENDB3SaNXktbmdNRGpyR/MH1gbGE0hLSR8/sKxeVEfLbC41b+io8HIdZGs3w18u3gSgQ==; skin=noskin; csm-hit=tb:1BKFH2GGPH64P7BTEGQ6+s-CE0QBWRFFFEXMT23RPY6|1556772172495&t:1556772172495&adb:adblk_no',
        "Host: www.amazon.com",
        "Postman-Token: 990f621a-4641-444a-962d-eb759e1fda54,72b00486-9db0-4313-811f-c4c5e3785650",
        "User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36",
        "accept-encoding: gzip, deflate",
        "cache-control: no-cache"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "段狼 cURL Error #:" . $err;
} else {
    // B07FFWGW2L
    file_put_contents('./duan', $response);
    $pattern = '/data-asin="B07FFWGW2L" data-index="(\d+)"/';

    preg_match($pattern, $response, $matches);

    if (isset($matches[1])) {
        $range = $matches[1] + 1;
        echo "么么哒,您的产品的广告加自然排名: ".$range;
    } else {
        echo '程序好辛苦,找了20页都没有找到您的产品~\n';
    }
}
