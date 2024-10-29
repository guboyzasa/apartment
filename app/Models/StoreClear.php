<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreClear extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public function room()
    {
        return $this->belongsTo(Room::class)->withTrashed();
    }

    // public function company()
    // {
    //     return $this->belongsTo(Company::class, 'company_id', 'id')->withTrashed();
    // }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class,'room_id','room_id')->withTrashed();
    }

    // public function youtube()
    // {
    //     return $this->belongsTo(Youtube::class, 'youtube_id','id')->withTrashed();
    // }
}
