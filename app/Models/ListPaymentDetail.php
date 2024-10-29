<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListPaymentDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function listPayment()
    {
        return $this->belongsTo(ListPayment::class);
    }
}
