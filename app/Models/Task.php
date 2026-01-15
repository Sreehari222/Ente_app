<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'priority',
        'created_by', 'area_operator_id', 'deo_id', 'salesman_id', 'status'
    ];

    // Relations
    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function areaOperator() {
        return $this->belongsTo(User::class, 'area_operator_id');
    }

    public function deo() {
        return $this->belongsTo(User::class, 'deo_id');
    }

    public function salesman() {
        return $this->belongsTo(User::class, 'salesman_id');
    }
}
