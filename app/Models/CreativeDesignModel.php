<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreativeDesignModel extends Model
{
    use HasFactory;
    protected $table = 'creative_design';
    protected $fillable = [
        'attendes_id',
        'cd_date_joined',
        'cd_service_commitment',
        'cd_status'
    ];
}
