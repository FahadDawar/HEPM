<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ClerkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clerks = User::latest()->paginate();
        return view('admin.clerks.index', compact('clerks'));
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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        User::create($validated);
        return response()->json(['message' => 'Clerk created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $clerk)
    {
        return response()->json($clerk);
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
    public function update(Request $request, User $clerk)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $clerk->id,
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        $clerk->update($validated);

        return response()->json(['message' => 'Clerk updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $clerk)
    {
        // fetch all the clerk's associated images and delete them as well
        $clerk->images->each(function ($image) {
            Storage::delete("encrypted_images/{$image->filename}");
        });

        $clerk->delete();

        return response()->json(['message' => 'Clerk deleted successfully']);
    }
}
