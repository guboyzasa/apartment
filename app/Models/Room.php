<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
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

    public function floor()
{
    return $this->belongsTo(Floor::class, 'floor_id');
}

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'room_id', 'id');
    }

}
