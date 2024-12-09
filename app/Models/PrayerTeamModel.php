<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrayerTeamModel extends Model
{
    use HasFactory;
    protected $table = 'prayer_team';
    protected $fillable = [
        'attendes_id',
        'prayer_team_date_joined',
        'prayer_team_service_commitment',
        'prayer_team_status'
    ];
}
