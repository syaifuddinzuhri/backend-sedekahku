<?php

namespace App\Models;

use App\Constants\UploadPathConstant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class PaymentAccount extends Model
{
    use HasFactory;

    protected $fillable = ['logo', 'name', 'account_name', 'account_number', 'is_active'];

    public function setLogoAttribute($value)
    {
        if ($value != null) {
            $this->attributes['logo'] = UploadPathConstant::PAYMENT_ACCOUNT . $value;
        }
    }

    public function getLogoAttribute()
    {
        if (empty($this->attributes['logo'])) {
            return asset('images/no-image-icon.png');
        }
        return $this->attributes['logo'] ?  URL::to('/') . '/' . $this->attributes['logo'] : null;
    }
}
