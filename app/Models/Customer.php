<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // public function room()
    // {
    //     return $this->belongsTo(Room::class);
    // }

    // public function room()
    // {
    //     return $this->belongsTo(Room::class,'company_id');
    // }
    public function room()
{
    return $this->belongsTo(Room::class, 'room_id');
}
}
