<?php

namespace App\Models\GoogleMap;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeoLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'route_name', 'start_location', 'end_location', 'distance', 'start_latitude', 'start_longitude', 'end_latitude', 'end_longitude'
    ];
}
