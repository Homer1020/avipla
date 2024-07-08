<?php

namespace App\Http\Controllers;

use App\Models\SocialNetwork;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SocialNetworkController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'facebook'  => 'nullable|url',
            'tiktok'    => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube'   => 'nullable|url',
            'twitter'   => 'nullable|url',
            'linkedin'  => 'nullable|url',
        ]);

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json([
                'success'   => false,
                'message'   => 'Validation errors',
                'data'      => $validator->errors()
            ]));
        }

        $payload = $validator->validated();
        
        $socialNetwork = SocialNetwork::first();

        if(!$socialNetwork) {
            SocialNetwork::create($payload);
        } else {
            $socialNetwork->update($payload);
        }

        return response()->json([
            'success'   => true,
            'message'   => 'Redes sociales actualizadas.',
            'data'      => $socialNetwork
        ]);
    }
}
