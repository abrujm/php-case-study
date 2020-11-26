<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = 'events';

    public static function getActiveEvents()
    {
        $date = date('Y-m-d');

        return Events::select('id', 'event_name', 'event_date', 'latitude', 'longitude')->where('event_date', '<=', $date)->get();
    }
}
