<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestDeposit extends Model
{
    use HasFactory;

    protected $table = "request_deposit";

    protected $fillable = [
        'phone',
        'money',
        'number',
        'name',
        'bank'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
