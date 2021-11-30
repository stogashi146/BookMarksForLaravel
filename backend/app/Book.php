<?php

namespace App;

// require 'vendor/autoload.php';
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;


class Book extends Model
{
    protected $fillable =[
        "title",
        "isbn",
        "author",
        "publisher_name",
        "image_url",
        "sales_date",
        "url"
    ];

    public static function search_books($keyword, $author=""){
        $keyword = "&keyword=".$keyword;
        $author = $author;
        $client = new \GuzzleHttp\Client();
        $url =  "https://app.rakuten.co.jp/services/api/BooksTotal/Search/20170404?applicationId=1099709005909964402&formatVersion=2&hits=28&booksGenreId=001004".$keyword;

        $response = $client->request(
            'GET',
            $url
        );
        $responseBody = $response->getBody()->getContents();
        $books = json_decode($responseBody,true);
        return $books;
    }

    public static function book_exists($book){
        return array(
            "title" => $book["title"],
            "isbn" => $book["isbn"],
            "author" => $book["author"],
            "publisher_name" => $book["publisherName"],
            "image_url" => str_replace("?_ex=200x200","",$book["largeImageUrl"]),
            "sales_date" => preg_replace("/年|月|日|頃/","",$book["salesDate"]),
            "url" => $book["itemUrl"]
        );
    }
}
