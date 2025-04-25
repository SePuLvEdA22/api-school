<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    // use softDeletes -> Permite borrar logicamente un registro (sin eliminarlo fisicamente).
    use SoftDeletes;

    // Indica los campos que pueden ser aginados masivamente.
    protected $fillable = [
        'name', 
        'surname', 
        'email', 
        'phone', 
        'student_id', 
        'status'];

    public function classrooms() 
    {
        /*
            - belongsToMany(Classroom::class) -> Relacion de muchos a muchos.
            - Usa una tabla intermedia (classroom_student).
            - withPivot() -> accede a columnas extra en la tabla pivote.
            - withTimestamps() -> La tabla pivote tiene las columnas created_at y updated_at.
        */
        return $this->belongsToMany(Classroom::class)
                    ->withPivot('enrollment_date', 'status')
                    ->withTimestamps();
    }
}
