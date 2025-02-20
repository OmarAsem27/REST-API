<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Setting extends Model
{
    use HasFactory;

    /**
     * Defining spatie media collection
     */


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'settings';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        // 'status' => Status::class,
    ];

    /**
     * fields ordering in filteration
     */
    const ORDER = [''];

    /**
     * Upload Path
     */
    const UPLOADPATH = '';

    /**
     * fields that will handle upload document
     */
    const UPLOADFIELDS = ['logo', 'slider_image_1', 'slider_image_2', 'slider_image_3', 'slider_image_4', 'about_image', 'goal_image', 'vision_image', 'ad_image_1', 'ad_image_2'];

    ##--------------------------------- RELATIONSHIPS


    ##--------------------------------- ATTRIBUTES


    ##--------------------------------- CUSTOM FUNCTIONS


    ##--------------------------------- SCOPES


    ##--------------------------------- ACCESSORS & MUTATORS
}
