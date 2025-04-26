<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class studentController extends Controller
{
    // Muestra todos los estudiantes registrados
    public function indexStudent() 
    {
        $student = Student::all();
        if ($student->isEmpty()) {
            $data = [
                'response' => 'No hay estudiantes registrados',
                'status' => 404
            ];
            return response()->json($data);
        }

        return response()->json($student, Response::HTTP_OK);
    }

    public function storeStudent(Request $request) 
    {
        $validator = Validator::make($request->all(),
        [
            'name'    => 'required|string|max:100',
            'surname' => 'required|string|max:100',
            'email'   => 'required|email|unique:students,email|max:150',
            'phone' => 'nullable|string|max:20',
            'student_id' => 'required|string|unique:students,student_id|max:50',
            'status' => 'required|in:active,inactive,graduated,suspended',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error in data validation',
                'error' => $validator->errors(),
                'status'  => 400
            ];
            return response()->json($data, 400);
        }

        // Crear estudiante
        $student = Student::create($request->all());

        $data = [
            'message' => 'Successfully registered student',
            'student' => $student,
            'status' => 201
        ];
        return response()->json($data, 201);
    }
}
