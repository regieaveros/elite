<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artists extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code'
    ];

    // public function albums()
    // {
    //     return $this->hasMany(Albums::class, 'id');
    // }
}
