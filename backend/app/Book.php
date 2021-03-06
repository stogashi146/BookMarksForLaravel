<?php

namespace App;

// require 'vendor/autoload.php';
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;


class Book extends Model
{

    public function reads()
    {
        return $this->hasMany("App\Read");
    }

    public function unreads()
    {
        return $this->hasMany("App\Unread");
    }

    protected $fillable =[
        "title",
        "description",
        "isbn",
        "author",
        "publisher_name",
        "image_url",
        "sales_date",
        "url"
    ];

    public static function search_books($keyword, $page = 1, $sales="standard", $genre="001004", $hits = 28){
        $keyword = "&keyword=".$keyword;
        $page = "&page=".$page;
        $client = new \GuzzleHttp\Client();
        $url =  "https://app.rakuten.co.jp/services/api/BooksTotal/Search/20170404?applicationId=".env('RAKUTEN_APPLICATION_ID')."&formatVersion=2&booksGenreId=".$genre."&sort=".$sales."&hits=".$hits.$keyword.$page;

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
            "description" => $book["itemCaption"],
            "isbn" => $book["isbn"],
            "author" => $book["author"],
            "publisher_name" => $book["publisherName"],
            "image_url" => str_replace("?_ex=200x200","",$book["largeImageUrl"]),
            "sales_date" => preg_replace("/年|月|日|頃/","",$book["salesDate"]),
            "url" => $book["itemUrl"]
        );
    }
}
