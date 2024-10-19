<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about.about-us');
    }
    public function blog(){
        return view('pages.blog.blog');
    }
    public function contact(){
        return view('pages.contact.contact-us');
    }
}
