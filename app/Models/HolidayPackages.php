<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; 

class HolidayPackages extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'price',
        'desc',
        'image',
        'unit',
        'code',
    ];

    protected static function booted()
    {
        static::creating(function ($transaction) {
            $transaction->code = Str::uuid()->toString();
        });
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
