<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StudentController extends Controller
{
    public function index () {
        $students = Student::get();

        if ($students->count() > 0) {
            return response()->json([
                'status' => 200,
                'students' => $students
            ], 200);
        }

        return response()->json([
            'status' => 404,
            'message'=> 'No records Found'
        ], 404);
    }


    public function store (Request $request) {
        try {
            $request->validate([
                'name' => ['required', 'max:200'],
                'course' => ['required', 'max:200', 'string'],
                'email' => ['required', 'email', 'max:200'],
                'phone' => ['required', 'digits:10']
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 422,
                'errors' => $e->errors()
            ], 422);
        }

        Student::create([
            'name' => $request->name,
            'course' => $request->course,
            'email' => $request->email,
            'phone' => $request->phone
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Student Created Successfully'
        ], 200);
    }


    public function show ($id) {
        $student = Student::where('id', $id)->first();
        if ($student) {
            return response()->json([
                'status' => 200,
                'student' => $student
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Record Found'
            ], 404);
        }
    }


    public function edit ($id) {
        $student = Student::where('id', $id)->first();
        if ($student) {
            return response()->json([
                'status' => 200,
                'student' => $student
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Record Found'
            ], 404);
        }
    }


    public function update (Request $request, $id) {
        try {
            $request->validate([
                'name' => ['required', 'max:200'],
                'course' => ['required', 'max:200', 'string'],
                'email' => ['required', 'email', 'max:200'],
                'phone' => ['required', 'digits:10']
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 422,
                'errors' => $e->errors()
            ], 422);
        }

        $student = Student::where('id', operator: $id)->update([
            'name' => $request->name,
            'course' => $request->course,
            'email' => $request->email,
            'phone' => $request->phone
        ]);

        if (!$student) {
            return response()->json([
                'status' => 404,
                'message' => 'No Record Found'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Student Updated Successfully'
        ], 200);
    }



    public function destroy ($id) {

        $student = Student::where('id', $id)->delete();

        if (!$student) {
            return response()->json([
                'status' => 404,
                'message' => 'No Record Found'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Student Deleted Successfully'
        ], 200);

    }
}
