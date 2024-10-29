<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreClearDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    // public function vendor()
    // {
    //     return $this->belongsTo(Vendor::class, 'vendor_id', 'id')->withTrashed();
    // }

    public function storeClear()
    {
        return $this->belongsTo(StoreClear::class);
    }

    public function listPayment()
    {
        return $this->belongsTo(ListPayment::class, 'list_payment_id');
    }

    // public function company()
    // {
    //     return $this->belongsTo(Company::class, 'company_id');
    // }

    // public function customer()
    // {
    //     return $this->hasOne(Customer::class, 'room_id', 'id');
    // }

}
