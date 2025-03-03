<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
