<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class One2OneModel extends Model
{
    use HasFactory;
    protected $table = 'one2one';
}
