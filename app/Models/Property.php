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
        'bedrooms',
        'bathrooms',
        'garages',
        'size',
        'image',
        'featured',
        'status',
        'user_id',
        'type_id',
        'latitude',
        'longitude',
        'views'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function type()
    {
        return $this->belongsTo(PropertyType::class, 'type_id');
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
