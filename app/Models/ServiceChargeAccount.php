<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceChargeAccount extends Model
{
    use HasFactory;
    protected $table = "service_charge_account";
    protected $primaryKey = "id";
    protected $fillable = ['user_id', 'amount', 'which_for', 'status'];
}
