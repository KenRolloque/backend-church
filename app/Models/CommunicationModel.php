<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunicationModel extends Model
{
    use HasFactory;

    protected $table = 'communication';
    protected $fillable = [
        'attendes_id',
        'communication_date_joined',
        'communication_service_commitment',
        'communication_status'
    ];
}
