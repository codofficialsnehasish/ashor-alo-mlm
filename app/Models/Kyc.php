<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Kyc extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'user_id',
        'identy_proof_type',
        'address_proof_type',
        'bank_ac_proof_type',
        'identy_proof',
        'identy_proof_status',
        'identy_proof_remarks',
        'address_proof',
        'address_proof_status',
        'address_proof_remarks',
        'bank_ac_proof',
        'bank_ac_proof_status',
        'bank_ac_proof_remarks',
        'pan_card_proof',
        'pan_card_proof_status',
        'pan_card_proof_remarks',
        'is_seen_by_admin',
        'is_confirmed',
        'confirmed_date'
    ];
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('kyc');
    }
}
