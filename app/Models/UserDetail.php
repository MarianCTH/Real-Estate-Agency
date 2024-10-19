<?php

// app/Models/UserDetail.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $fillable = ['user_id', 'address', 'phone', 'email'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
