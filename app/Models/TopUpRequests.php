<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopUpRequests extends Model
{
    use HasFactory;
    protected $table = "top_up_requests";
    protected $primaryKey = "id";
}