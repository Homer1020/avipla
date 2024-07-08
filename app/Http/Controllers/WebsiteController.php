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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
