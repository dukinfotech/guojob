<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Payment;

class RequestRecharge extends Model
{
    use HasFactory;

    protected $table = "request_recharge";

    protected $fillable = [
        'code',
        'money'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function payment() {
        return $this->belongsTo(Payment::class);
    }
}
