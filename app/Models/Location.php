<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['name'];

    // Define the relationship with Property
    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
