<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\JuntaDirectiva;
use App\Models\JuntaDirectivaRole;
use App\Models\Organismo;
use App\Models\SocialNetwork;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carousels = Carousel::all();
        $socialNetworks = SocialNetwork::first() ?? new SocialNetwork();
        $organismos = Organismo::all();
        $juntaDirectivaRoles = JuntaDirectivaRole::all();
        $juntaDirectivas = JuntaDirectiva::with('role')->get();
        return view('website.index', compact('carousels', 'socialNetworks', 'organismos', 'juntaDirectivaRoles', 'juntaDirectivas'));
    }
}
