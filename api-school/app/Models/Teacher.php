<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    // softDelete -> Significa que cuando se elimine un profesor, no se borrara de la base de datos, 
    // sino que se le asignara una fecha en la columna deleted_at
    use SoftDeletes;

    /*
        Define los campos que pueden ser llenados masivamente. 
        Es una medida de seguridad para que solo estos campos
        puedan ser usados en metodos como create() o update(). 
    */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'phone',
        'employee_id',
        'specialization',
        'status',
        
    ];

    // Define una relacion muchos a muchos con el metodo Classroom.
    public function classroom()
    /*
        - belongsToMany(Classroom::class) -> Un profesor puede estar asignado a varias aulas, 
          y un aula puede tener varios profesores.
        - withPivot(...) -> Indica que la tabla intermedia (classroom_teacher) contiene columnas adicionales
          (subject, role, assignment_date).
        - withTimestamps() -> Laravel gestionara automaticamente las columnas created_at y updated_at en la 
          tabla intermedia
    */
    {
        return $this->belongsToMany(Classroom::class)
                    ->withPivot('subject', 'role', 'assignment_date')
                    ->withTimestamps();
    }
}
