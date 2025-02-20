<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name', 'cui', 'address', 'email', 'mobile_phone', 'image', 'leader_id'];

    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'company_id');
    }
    public function properties()
    {
        return $this->hasManyThrough(Property::class, User::class, 'company_id', 'user_id', 'id', 'id');
    }

    public function members()
    {
        return $this->hasMany(User::class, 'company_id');
    }
    public function joinRequests()
    {
        return $this->hasMany(JoinRequest::class);
    }

}
