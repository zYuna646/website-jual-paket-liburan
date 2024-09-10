<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; 

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'holiday_package_id',
        'quantity',
        'status',
        'code'
    ];


    protected static function booted()
    {
        static::creating(function ($transaction) {
            $transaction->code = Str::uuid()->toString();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function holidayPackage()
    {
        return $this->belongsTo(HolidayPackages::class);
    }
}
