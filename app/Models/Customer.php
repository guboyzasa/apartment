<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id')->withTrashed();
    }

    public function statusList()
    {
        return $this->belongsTo(Status::class, 'status_id','id')->withTrashed();
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id','id');
    }

}
