<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emploie extends Model
{
    use HasFactory;
    protected $fillable = [

        'teacher_id',
        'title',
        'start_at',
        'end_at',
        'color',
    ];

    public function teachers()
     {
         return $this->belongsTo(Teacher::class, 'teacher_id' );
     }
}
