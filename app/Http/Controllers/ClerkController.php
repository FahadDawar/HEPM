<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Clinician;
use Illuminate\Http\Request;

class ClerkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // get all clinicians which has assigned image pending which the relationship is defined in the Clinician model as pendingImage()
        // $clinicians = Clinician::whereHas('pendingImage')
        //     ->with('pendingImage')
        //     ->latest()
        //     ->paginate();

            $images = Image::whereHas('clinician')
            ->with('clinician')
            ->where('user_id', auth()->id())
            ->where('status', 'pending')
            ->latest()->paginate();

            // dd($images);

        return view('dashboard', compact('images'));
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
