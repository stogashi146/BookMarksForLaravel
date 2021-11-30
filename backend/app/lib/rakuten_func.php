<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new \GuzzleHttp\Client();
// $app_id = ;
$url =  "https://app.rakuten.co.jp/services/api/BooksTotal/Search/20170404?applicationId=1099709005909964402&formatVersion=2&keyword=鬼滅&hits=2";
$response = $client->request(
    'GET',
    $url
);
// echo $response->getStatusCode(); // 200
// echo $response->getReasonPhrase(); // OK
// echo $response->getProtocolVersion(); // 1.1
// レスポンスボディを取得
$responseBody = $response->getBody()->getContents();
$books=json_decode($responseBody,true);
// $books["Items"][1]["title"]
