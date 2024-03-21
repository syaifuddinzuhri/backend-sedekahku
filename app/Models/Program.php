<?php

namespace App\Models;

use App\Constants\UploadPathConstant;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class Program extends Model
{
    use HasFactory;

    protected $appends = [
        'total',
        'duration'
    ];

    protected $fillable = [
        'name',
        'slug',
        'description',
        'thumbnail',
        'end_date'
    ];

    /**
     * Get all of the images for the Program
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(Images::class);
    }

    public function setThumbnailAttribute($value)
    {
        if ($value != null) {
            $this->attributes['thumbnail'] = UploadPathConstant::PROGRAM_THUMBNAIL . $value;
        }
    }

    public function getThumbnailAttribute()
    {
        if (empty($this->attributes['thumbnail'])) {
            return asset('images/no-image-icon.png');
        }
        return $this->attributes['thumbnail'] ?  URL::to('/') . '/' . $this->attributes['thumbnail'] : null;
    }

    public function getTotalAttribute()
    {
        try {
            $total = Payment::where('program_id', $this->attributes['id'])->where('status', 1)->sum('nominal');
            return $total;
        } catch (\Throwable $th) {
            return 0;
        }
    }

    public function getDurationAttribute()
    {
        try {
            $endDate = $this->attributes['end_date'];
            if (isset($endDate)) {
                return Carbon::parse($endDate)->diffForHumans();
            }
            return "Tidak Terbatas";
        } catch (\Throwable $th) {
            return "Tidak Terbatas";
        }
    }

    public static function boot()
    {
        parent::boot();

        // Event handler for creating a new program
        static::creating(function ($program) {
            $slug = Str::slug($program->name); // Generate slug from the name
            $count = Program::where('slug', 'like', $slug . '%')->count();
            if ($count > 0) {
                $program->slug = $slug . '-' . ($count + 1);
            } else {
                $program->slug = $slug;
            }
        });

        // Event handler for updating an existing program
        static::updating(function ($program) {
            $slug = Str::slug($program->name); // Generate slug from the name
            $count = Program::where('slug', 'like', $slug . '%')->where('id', '!=', $program->id)->count();
            if ($count > 0) {
                $program->slug = $slug . '-' . ($count + 1);
            } else {
                $program->slug = $slug;
            }
        });
    }
}
