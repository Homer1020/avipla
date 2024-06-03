<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function home() {
        return view('home');
    }

    public function aboutus() {
        return view('aboutus');
    }

    public function services() {
        return view('services');
    }

    public function affiliation() {
        return view('affiliation');
    }

    public function news() {
        return view('news');
    }

    public function contact() {
        return view('contact');
    }
}
