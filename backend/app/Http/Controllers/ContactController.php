<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
{
    public function contact(Request $request)
    {
        $categories = ["service" => "サービスについて", "info" => "登録情報について", "other" => "その他"];
        return view('contact/contact', ["categories" => $categories]);
    }

    public function confirm(Request $request)
    {
        $categories = ["service" => "サービスについて", "info" => "登録情報について", "other" => "その他"];
        $email = request("email");
        $category = $categories[request("category")];
        $content = request("content");

        return view('contact/confirm', ["email" => $email, "category" => $category, "content" => $content]);
    }
}
