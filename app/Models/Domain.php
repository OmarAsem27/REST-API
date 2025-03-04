<?php

namespace App\Models;

use App\Enums\AdStatus;
use App\Enums\DomainStatuses;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{


    protected $casts = [
        'status' => DomainStatuses::class,
    ];


    public function ads()
    {
        return $this->hasMany(Ad::class);
    }

    public function approvedAds()
    {
        return $this->hasMany(Ad::class)->where('status', AdStatus::APPROVED);
    }
}
