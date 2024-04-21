<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curse extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'ambit_id'];

    public function ambit()
    {
        return $this->belongsTo(Ambit::class);
    }

    public function disciplines()
    {
        return $this->hasMany(Discipline::class);
    }

    public function studentClasses()
    {
        return $this->hasMany(StudentClass::class);
    }
}
