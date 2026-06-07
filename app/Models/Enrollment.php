<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'child_name',
        'child_age',
        'club',
        'parent_phone',
        'notes',
        'processed',
    ];

    protected $casts = [
        'processed' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
