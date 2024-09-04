<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSectorIncome extends Model
{
    use HasFactory;
    protected $table = "product_sector_incomes";
    protected $primaryKey = "id";
}
