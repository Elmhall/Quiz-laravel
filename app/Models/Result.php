<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function quiz(){
        return $this->belongsTo(Quiz::class);
    }
}
