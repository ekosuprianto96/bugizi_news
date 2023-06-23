<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailWebsite extends Model
{
    use HasFactory;
    protected $table = 'detail_website';
    protected $fillable = [
        'app_id',
        'app_name'
    ];
}
