<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KidsModel extends Model
{
    use HasFactory;
    protected $table = 'kids';
    protected $fillable = [
        'attendes_id',
        'kids_date_joined',
        'kids_service_commitment',
        'kids_status'
    ];
}
