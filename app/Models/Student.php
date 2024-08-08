<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;


class Student extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    protected $fillable = [
        'nom',
        'prenom',
        'cin',
        'date_de_naissance',
        'adress',
        'email',
        'classe',
        'payment',
        'photo',
    ];

    public function classes()
    {
        return $this->belongsTo(Classes::class, 'classe' );
    }



        public function registerMediaConversions(?Media $media = null): void
        {
            $this
                ->addMediaConversion('preview')
                ->fit(Fit::Contain, 300, 300)
                ->nonQueued();
        }
}
