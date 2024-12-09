<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminMinistryModel extends Model
{
    use HasFactory;
    protected $table = 'admin_ministry';
    protected $fillable = [
        'attendes_id',
        'am_date_joined',
        'am_service_commitment',
        'am_status'
    ];
}
