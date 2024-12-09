<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechModel extends Model
{
    use HasFactory;
    protected $table = 'technical_and_stage_management';
    protected $fillable = [
        'attendes_id',
        'date_joined',
        'service_commitment',
        'status'
    ];
}
