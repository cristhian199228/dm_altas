<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anammesis extends Model
{
    use HasFactory;

    protected $table = "seguimiento_anammesis";

    protected $guarded = [];
}
