<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyMessage extends Model
{
    use HasFactory;
     protected $fillable = [
        'title',
        'subject',
        'message',
    ];
}
