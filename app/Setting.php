<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Setting extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'value'
    ];


    /**
     * Tell the Model this Table doesn't support timestamps.
     *
     * @var bool
     */
    public $timestamps = false;

    public static function get_value($key)
    {
        if (DB::connection()->getDatabaseName()) {
            return self::where('key', $key)->first()->value;
        }
        return false;
    }

    public static function databaseReady()
    {
        $path = base_path().'/database/database.sqlite';

        if(file_exists($path) && filesize($path) > 0) {
            return true;
        }
        return false;
    }

}