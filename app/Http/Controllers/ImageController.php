<?php

namespace App\Http\Controllers;

use App\Models\Image;
use ZipStream\ZipStream;
use App\Models\Clinician;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Notifications\ImageAssignedNotification;
use Illuminate\Notifications\DatabaseNotification;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get online clinicians
        $onlineClinicians = Clinician::where('user_id', auth()->id())
            ->where('is_online', true)
            ->paginate(30);

        $images = Image::with('clinician')
        ->where('user_id', auth()->id())
        ->latest()->paginate();

        $notifications = auth()->user()->unreadNotifications;

        return view('images.index', compact('images', 'onlineClinicians', 'notifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function assign_clinician(Request $request, Image $image)
    {
        $request->validate([
            'clinician_id' => 'required|integer|exists:clinicians,id',
        ]);

       $image->update([
            'clinician_id' => $request->clinician_id,
        ]);

        if($image){
            // send notification to the clinician
            $clinician = Clinician::find($request->clinician_id);
            $clinician->notify(new ImageAssignedNotification($image));
        }

        return response()->json([
            'message' => 'Clinician assigned successfully.',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreImageRequest $request)
    {
        $encryptedImage = encrypt(file_get_contents($request->file('image')->getRealPath()));

        $filename = time() . '.' . $request->file('image')->extension();

        Storage::put("encrypted_images/{$filename}", $encryptedImage);

        Image::create([
            'user_id'  => auth()->id(),
            'filename' => $filename,
        ]);

        return response()->json([
            'message'  => 'Image stored successfully.',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($filename)
    {
        // first check if the payload is valid
        if (!Storage::exists("encrypted_images/{$filename}")) {
            return response()->json([
                'message' => 'Image not found.',
            ], 404);
        }
        $decryptedImage = decrypt(Storage::get("encrypted_images/{$filename}"));

        return response($decryptedImage)->header('Content-Type', 'image/' . pathinfo($filename, PATHINFO_EXTENSION));
    }

    // show annotated image along with clinician details
    public function annotated_image($filename)
    {
        $fileArr = explode('&', $filename);
        $filename = $fileArr[0];
        $id = $fileArr[1];
        // dd($filename, $fileArr);
        if (!$filename){
            return response()->json([
                'message' => 'Image not found.',
            ], 404);
        }
        $filename = htmlspecialchars(strip_tags($filename));
        $id = htmlspecialchars(strip_tags($id));
        // first check if the payload is valid
        if (!Storage::exists("encrypted_images/{$filename}")) {
            return response()->json([
                'message' => 'Image not found.',
            ], 404);
        }

        $image = Image::with('clinician:id,name')->where('filename', $filename)->first();

        // mark as read the notification where the filename is equal to the image filename
        DatabaseNotification::where('id', $id)->update(['read_at' => now()]);

        return response()->json([
            'image' =>$image,
        ]);
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

    // download bulk images
    public function download_bulk_images(Request $request)
    {
        $filenames = $request->images[0];
        $filenames = explode(',', $filenames);

        return response()->streamDownload(function () use ($filenames) {
            $zip = new ZipStream('images.zip');

            foreach ($filenames as $filename) {
                if (!Storage::exists("encrypted_images/{$filename}")) {
                    // Handle missing image
                    continue;
                }

                $decryptedImage = decrypt(Storage::get("encrypted_images/{$filename}"));
                $zip->addFile($filename, $decryptedImage);
            }

            $zip->finish();
        }, 'images.zip');

    }

    // delete bulk images
    public function delete_bulk_images(Request $request)
    {
        $filenames = $request->deleteImages[0];
        $filenames = explode(',', $filenames);

        foreach ($filenames as $filename) {
            if (Storage::exists("encrypted_images/{$filename}")) {
                Storage::delete("encrypted_images/{$filename}");
            }
            Image::where('filename', $filename)->delete();
        }


        return back()->with('success', 'Images deleted successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        if (Storage::exists("encrypted_images/{$image->filename}")) {
            Storage::delete("encrypted_images/{$image->filename}");
        }

        // delete all associated notifications of the image
        DatabaseNotification::where('data->image_id', $image->id)->delete();

        $image->delete();
        return response()->json([
            'message' => 'Image deleted successfully.',
        ]);
    }
}
