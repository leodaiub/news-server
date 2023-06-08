<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePreferencesRequest;
use App\Http\Requests\UpdatePreferencesRequest;
use App\Models\Preferences;

class PreferencesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePreferencesRequest $request)
    {

        $preferences = auth()->user()->preferences()->create($request->all());
        return $preferences->save();
    }
}