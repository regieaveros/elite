<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Albums extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cover',
        'sales',
        'date'
    ];

    // public function artist()
    // {
    //     return $this->belongsTo(Artists::class, 'id');
    // }
}
