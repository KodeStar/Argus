<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Camera extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cameras';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key', 'name', 'ip', 'feed', 'status', 'preview'
    ];

    public static function populate($cameras)
    {
        foreach($cameras as $camera) {
            self::create($camera);
        }
    }

}
