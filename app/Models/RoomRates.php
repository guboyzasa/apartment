<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomRates extends Model
{
    use HasFactory;
    use SoftDeletes;

    // public function vendor()
    // {
    //     return $this->belongsTo(Vendor::class, 'vendor_id', 'id')->withTrashed();
    // }

    public function floorList()
    {
        return $this->belongsTo(Floor::class)->withTrashed();
    }

    // public function room()
    // {
    //     return $this->belongsTo(Room::class, 'room','id');
    // }

}
