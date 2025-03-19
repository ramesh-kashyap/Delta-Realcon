<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{

    public function index()
    {
        return view('main.home');
    }

    public function about()
    {
        return view('main.about');
    }

    public function services()
    {
        return view('main.services');
    }
    public function Blog()
    {
        return view('main.blogDetail');
    }
    public function contact()
    {
        return view('main.contact');
    }
    public function addProperties()
    {
        return view('main.add-properties');
    }
    public function detailProperties()
    {
        return view('main.properties-detail');
    }
    public function faq()
    {
        return view('main.faq');
    }
   
    public function aitrading()
    {
        return view('main.aitrading');
    }

    public function affiliate()
    {
        return view('main.affiliate');
    }
    public function termcandition()
    {
        return view('main.term-candition');
    }

    public function partners()
    {
        return view('main.partners');
    }
 public function news()
    {
        return view('main.news');
    }



}
