<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;




class Note extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_matiere',
        'id_student',
        'note_TP',
        'note_TD',
        'note_examen',
        'coef_note_TP',
        'coef_note_TD',
        'coef_note_examen',
        'moyenne',
        'periode',
    ];
    public function students()
    {
        return $this->belongsTo(Student::class, 'id_student');
    }
    public function matieres()
    {
        return $this->belongsTo(matiere::class, 'id_matiere');
    }




}
