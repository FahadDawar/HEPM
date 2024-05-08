<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Image;
use App\Models\Clinician;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ImageInnotateRequest;
use App\Http\Requests\StoreClinicianRequest;
use App\Http\Requests\UpdateClinicianRequest;

class ClinicianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clinicians = Clinician::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate();

        return view('clinicians', compact('clinicians'));
    }

    public function dashboard()
    {
        $assignedImages = Image::where('clinician_id', auth('clinician')->id())
            ->orderBy('created_at', 'desc')
            ->paginate();

        // dd($assignedImages);
        return view('clinicians.dashboard', compact('assignedImages'));

    }

    // download the image
    public function download_image($filename)
    {
        if (!Storage::exists("encrypted_images/{$filename}")) {
            return response()->json([
                'message' => 'Image not found.',
            ], 404);
        }
        $decryptedImage = decrypt(Storage::get("encrypted_images/{$filename}"));

        // download the image to the user's device
        return response($decryptedImage)
           ->header('Content-Type', 'image/' . pathinfo($filename, PATHINFO_EXTENSION))
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
            
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clinicians.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClinicianRequest $request)
    {
        $validated = $request->validated();
        // append user_id to the validated data
        $validated['user_id'] = auth()->id();

        $clinician = Clinician::create($validated);

        if (!$clinician) {
            return response()->json([
                'message' => 'Failed to create clinician'
            ], 500);
        }

        return response()->json([
            'message' => 'Clinician created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show_image($filename)
    {
        if (!Storage::exists("encrypted_images/{$filename}")) {
            return response()->json([
                'message' => 'Image not found.',
            ], 404);
        }
        $decryptedImage = decrypt(Storage::get("encrypted_images/{$filename}"));

        return response($decryptedImage)->header('Content-Type', 'image/' . pathinfo($filename, PATHINFO_EXTENSION));
    }

    public function innotate_image(ImageInnotateRequest $request, Image $image)
    {
        $image->update([
            'status' => str($request->status)->lower(),
            'note'   => $request->note
        ]);

        return response()->json([
            'message' => 'Image innotated successfully'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function show(Clinician $clinician)
    {

        return response()->json($clinician);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClinicianRequest $request, Clinician $clinician)
    {

        $clinician->update($request->validated());

        return response()->json([
            'message' => 'Clinician updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clinician $clinician)
    {

        if (!$clinician->delete()) {
            return response()->json([
                'message' => 'Failed to delete clinician'
            ], 500);
        }

        return response()->json([
            'message' => 'Clinician deleted successfully'
        ]);

    }
}
