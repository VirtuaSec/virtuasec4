<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    use HasFactory;

    protected $fillable = ['name','curse_id','limit'];

    public function curse()
    {
        return $this->belongsTo(Curse::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'student_class_users', 'student_class_id', 'user_id');
    }
}
