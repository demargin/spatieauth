<?php

namespace App\Http\Controllers\api;

use Illuminate\Support\Facades\Validator;

use App\Models\Student_Model;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function index()
    {

        $students = Student_Model::all();

        if($students->count() > 0){

            return response()->json([
                'status' => 200,
                'students' => $students
            ], 200);
        }else{

            return response()->json([
                'status' => 404,
                'status_message' => 'No records found'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:80',
            'course' => 'required|string|max:190',
            'email' => 'required|email|max:80',
            'phone' => 'required|digits:10'
        ]);

        if($validator->fails()){

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }else{

            $student = Student_Model::create([
                'name' => $request->name,
                'course' => $request->course,
                'email' => $request->email,
                'phone' => $request->phone
            ]);

            if($student){

                return response()->json([
                    'status' => 200,
                    'message' => "Student Created Successfully"
                ],200);
            }else{

                return response()->json([
                    'status' => 500,
                    'message' => "Something went wrong"
                ],500);
            }
        }
    }

    public function show($id){

        $student = Student_Model::find($id);
        if($student){

            return response()->json([
                'status' => 200,
                'student' => $student
            ],200);
        }else{

            return response()->json([
                'status' => 404,
                'message' => "Not such a student found"
            ],404);
        }
    }

    public function edit($id){

        $student = Student_Model::find($id);
        if($student){

            return response()->json([
                'status' => 200,
                'student' => $student
            ],200);
        }else{

            return response()->json([
                'status' => 404,
                'message' => "Not such a student found"
            ],404);
        }
    }

    public function update(Request $request, int $id){

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:80',
            'course' => 'required|string|max:190',
            'email' => 'required|email|max:80',
            'phone' => 'required|digits:10'
        ]);

        if($validator->fails()){

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }else{

            $student = Student_Model::find($id);



            if($student){

                $student->update([
                    'name' => $request->name,
                    'course' => $request->course,
                    'email' => $request->email,
                    'phone' => $request->phone,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => "Student Updated Successfully"
                ],200);
            }else{

                return response()->json([
                    'status' => 404,
                    'message' => "Not such a student found for updating"
                ],404);
            }
        }
    }

    public function delete($id){

        $student = Student_Model::find($id);

        if($student){

            $student->delete();

            return response()->json([
                'status' => 200,
                'message' => "the student record was deleted successfully"
            ],200);

        }else{

            return response()->json([
                'status' => 404,
                'message' => "Not such a student found for updating"
            ],404);
        }
    }

}
