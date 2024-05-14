<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Image extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'clinician_id',
        'filename',
        'note',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'No Clerk'
        ]);
    }

    public function clinician()
    {
        return $this->belongsTo(Clinician::class)->withDefault(['name' => 'Not Assigned']);
    }
}
