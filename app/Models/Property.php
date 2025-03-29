<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Property extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'price',
        'location',
        'city',
        'bedrooms',
        'bathrooms',
        'garages',
        'size',
        'image',
        'featured',
        'status_id',
        'user_id',
        'type_id',
        'latitude',
        'longitude',
        'views'
    ];

    protected $casts = [
        'price' => 'integer',
        'views' => 'integer',
        'featured' => 'boolean'
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($property) {
            // No need to set formatted_price as it's not in the database
            // We'll handle price formatting in the accessor
        });
    }

    public function setPriceAttribute($value)
    {
        // Remove any non-numeric characters and convert to integer
        $cleanValue = preg_replace('/[^0-9]/', '', $value);
        $this->attributes['price'] = (int)$cleanValue;
    }

    public function getPriceAttribute($value)
    {
        return (int)$value;
    }

    public function getFormattedPriceAttribute()
    {
        // Format the price with dots as thousand separators
        return number_format($this->price, 0, ',', '.');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function type()
    {
        return $this->belongsTo(PropertyType::class, 'type_id');
    }
    public function propertyStatus()
    {
        return $this->belongsTo(PropertyStatus::class, 'status_id');
    }
    public function status()
    {
        return $this->belongsTo(PropertyStatus::class, 'status_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }
}
