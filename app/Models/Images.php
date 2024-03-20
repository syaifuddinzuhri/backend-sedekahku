<?php

namespace App\Models;

use App\Constants\UploadPathConstant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class Images extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'image'
    ];

    public function setImageAttribute($value)
    {
        if ($value != null) {
            $this->attributes['image'] = UploadPathConstant::PROGRAM_IMAGES . $value;
        }
    }

    public function getImageAttribute()
    {
        if (empty($this->attributes['image'])) {
            return asset('images/no-image-icon.png');
        }
        return $this->attributes['image'] ?  URL::to('/') . '/' . $this->attributes['image'] : null;
    }
}
