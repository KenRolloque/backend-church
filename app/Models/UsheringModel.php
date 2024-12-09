<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsheringModel extends Model
{
    use HasFactory;

    protected $table = 'usheringa_and_security';
    protected $fillable = [
        'attendes_id',
        'uas_date_joined',
        'uas_service_commitment',
        'uas_status'
    ];
}
