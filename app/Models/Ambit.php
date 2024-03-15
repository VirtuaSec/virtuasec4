<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambit extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'email', 'hotsite'];

    public function curses()
    {
        return $this->hasMany(Curse::class);
    }
}
