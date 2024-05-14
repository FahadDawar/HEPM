<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Image;
use App\Models\Clinician;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ImageInnotateRequest;
use App\Http\Requests\StoreClinicianRequest;
use App\Http\Requests\UpdateClinicianRequest;
use App\Notifications\ImageAnnotatedNotification;
use Illuminate\Notifications\DatabaseNotification;

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

            $notifications = auth()->user()->unreadNotifications;


        return view('clinicians', compact('clinicians', 'notifications'));
    }
    public function dashboard()
    {
        $assignedImages = Image::where('clinician_id', auth('clinician')->id())
            ->orderBy('created_at', 'desc')
            ->paginate();

            $notifications = auth()->user()->unreadNotifications;

            // dd($notifications);
        return view('clinicians.dashboard', compact('assignedImages', 'notifications'));

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


        if($request->has('notification_id')){
            $id =(string) htmlspecialchars(strip_tags($request->notification_id));
        }



        $is_annotated = $image->update([
            'status' => str($request->status)->lower(),
            'note'   => $request->note
        ]);

        if($is_annotated) {
            $image->user->notify(new ImageAnnotatedNotification($image));
        }

        // mark the annotated image notification as read for clinician
        if(! $request->has('notification_id')){

            DatabaseNotification::where('data->image_id', $image->id)
              ->where('data->user_id', auth('clinician')->id())
            ->update(['read_at' => now()]);
        } else {
            DatabaseNotification::where('id', $id)
            ->update(['read_at' => now()]);
        }


        return response()->json([
            'message' => 'Image annotated successfully'
        ]);
    }

       /**
     * Get unread notifications
     */
    public function notifications()
    {
        $notifications = auth('clinician')->user()->unreadNotifications;

        $notification_count = count($notifications);

        return response()->json([
            'notifications' => $notifications,
            'notification_count' => $notification_count
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
