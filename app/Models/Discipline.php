<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'curse_id'];

    public function curse()
    {
        return $this->belongsTo(Curse::class);
    }
}
