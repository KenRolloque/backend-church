<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MusicTeamModel extends Model
{
    use HasFactory;
    protected $table = 'music_team';
    protected $fillable = [
        'attendes_id',
        'mt_date_joined',
        'mt_service_commitment',
        'mt_status'
    ];

}
