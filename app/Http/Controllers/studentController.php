<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    function addStudent(Request $request)
    {

        $mes = Validator::make(
            $request->all(),
            [
                // 'fees' => 'required',
                'name' => 'required',
                'villege' => 'required',
                'taluka' => 'required',
                'district' => 'required',
                'postcode' => 'required|numeric',
                'joining_date' => 'required',
                'father_phone' => 'required | numeric',
                'phone' => 'required| numeric| min:10',
                'photo' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            ]

        );
        // dd($mes);
        if ($mes->fails()) {
            // Failed
            return back()->with('errors', $mes->errors());
        } else {
            // Pass
            $imageName = time() . '.' . $request->photo->extension();

            // Public Folder
            $photo = $request->photo->move('images', $imageName);
            // dd($photo);
            // //Store in Storage Folder
            // $request->image->storeAs('images', $imageName);

            // // Store in S3
            // $request->image->storeAs('images', $imageName, 's3');

            DB::table('students')->insert([
                'reciept' => 1,
                'photo' => $photo,
                'name' => $request->name,
                'fees_status' => "Unpaid",
                'phone' => $request->phone,
                'father_phone' => $request->father_phone,
                'joining_date' => $request->joining_date,
                'villege' => $request->villege,
                'district' => $request->district,
                'town' => $request->taluka,
                'postcode' => $request->postcode,
                'status' => $request->status,
                'last_exam' => $request->last_exam,
                // 'father_name' => $request->last_exam,
                'current_college_year' => $request->current_college_year,
                'college_name' => $request->college_name,
                'college_address' => $request->college_address,
                'created_at' => date('Y-m-d'),
            ]);

            return back()->with('success', "Student Add Successfuly");
        }
    }

    function showAddStudent(){
        return view('admin_views.add-student');
    }

    //Get Employee List
    function showManageEmployee(){
        $employee = DB::table('students')->orderBy('id', 'desc')->where('status', '=', 'Employee')->orWhere('status', '=', 'Other')->get(); 
        $count = $employee->count();
        $i=1;
        return view('admin_views.employee-list', ['employee' => $employee, 'count' => $count, 'i' => $i]);
    }

    //Get Student List
    function showManageStudent(){
        $students = DB::table('students')->orderBy('id', 'desc')->where('status', '=', 'Student')->get();
        $count = $students->count();
        $i=1;

        return view('admin_views.student-list', ['students' => $students, 'count' => $count, 'i' => $i]);
    }
}
