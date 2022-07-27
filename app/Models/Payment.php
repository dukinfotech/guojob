<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RequestRecharge;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'receiver',
        'number',
        'bank',
        'bank_logo',
    ];

    public function requestRecharges() {
        return $this->hasMany(RequestRecharge::class);
    }

    public function requestDeposits() {
        return $this->hasMany(RequestDeposit::class);
    }
}
