<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListPayment extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
    public function lastStoreClearDetail()
    {
        return $this->hasOne(StoreClearDetail::class, 'list_payment_id','id')->orderBy('created_at','desc');
    }

    public function listPaymentDetails()
    {
        return $this->hasMany(listPaymentDetail::class,'list_payment_id','id');
    }
}
