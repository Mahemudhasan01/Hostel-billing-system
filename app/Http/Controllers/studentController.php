<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    function addStudent($sid, Request $request)
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
                'photo' => 'image|mimes:png,jpg,jpeg|max:2048',
            ]

        );
        // dd($mes);
        if ($mes->fails()) {
            // Failed
            return back()->with('error', 'Please fill all required field!.');
        } else {
            // Update Student
            if($sid != 0){
                if($request->hasFile('photo')){
                    $imageName = time() . '.' . $request->photo->extension();
                    // Public Folder
                    $photo = $request->photo->move('images', $imageName);
                }else{
                    $photo = $request->oldPhoto;
                }

                DB::table('students')
                    ->where("id", "=", $sid)
                    ->update([
                    'reciept' => "Null",
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
                    'status' => $request->status ? $request->status : "Guest",
                    'last_exam' => $request->last_exam ? $request->last_exam : "Null",
                    'room_no' => $request->room_no ? $request->room_no : "Null",
                    // 'father_name' => $request->last_exam,
                    'current_college_year' => $request->current_college_year ? $request->current_college_year: "Null",
                    'college_name' => $request->college_name ? $request->college_name : "Null",
                    'college_address' => $request->college_address ? $request->college_address : "Null",
                    'created_at' => date('Y-m-d'),
                ]);

                return redirect()->route("show.manage.student")->with('success', 'Student update successfully!');
            }else{
                if($request->hasFile('photo')){
                    $imageName = time() . '.' . $request->photo->extension();
                    // Public Folder
                    $photo = $request->photo->move('images', $imageName);
                }else{
                    $photo = "";
                }

                DB::table('students')->insert([
                    'reciept' => "Null",
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
                    'status' => $request->status ? $request->status : "Guest",
                    'last_exam' => $request->last_exam ? $request->last_exam : "Null",
                    'room_no' => $request->room_no ? $request->room_no : "Null",
                    // 'father_name' => $request->last_exam,
                    'current_college_year' => $request->current_college_year ? $request->current_college_year: "Null",
                    'college_name' => $request->college_name ? $request->college_name : "Null",
                    'college_address' => $request->college_address ? $request->college_address : "Null",
                    'created_at' => date('Y-m-d'),
                ]);

                return back()->with('success', 'Student create successfully!');
            }
            
        }
    }

    function showAddStudent(){
        $rooms = DB::table("rooms")->get();
        $student = "";
        $opType = "new";

        return view('admin_views.add-student', ["student" => $student, "opType" => $opType, "rooms" => $rooms]);
    }

    //Get Employee List
    function showManageEmployee($roomId = 0){
        // dd($roomId);
        if($roomId != 0){
            $employee = DB::table('students')->orderBy('id', 'desc')->where('status', '=', 'Employee')->where('room_no', '=', $roomId)->get(); 
            
            $count = $employee->count();
            $i=1;
            return response()->json([$employee, $count, $i]);
        }else{
            $employee = DB::table('students')->orderBy('id', 'desc')->where('status', '=', 'Employee')->orWhere('status', '=', 'Guest')->get(); 
            $rooms = DB::table("rooms")->get();

            $count = $employee->count();
            $i=1;
            return view('admin_views.employee-list', ['employee' => $employee, 'count' => $count, 'i' => $i, 'rooms' => $rooms]);
        }
    }

    //Get Student List
    function showManageStudent($roomId=0){
        // dd($roomId);
        if($roomId){
            $students = DB::table('students')->orderBy('id', 'desc')->where('status', '=', 'Student')->where('room_no', '=', $roomId)->get();
            $count = $students->count();
            $i=1;
            
            return response()->json([$students, $count, $i]);
            //return view('admin_views.student-list', ['students' => $students, 'count' => $count, 'i' => $i, 'rooms' => $rooms]);
        }else{
            $students = DB::table('students')->orderBy('id', 'desc')->where('status', '=', 'Student')->get();
            $rooms = DB::table('rooms')->get();
            $count = $students->count();
            $i=1;
            
            return view('admin_views.student-list', ['students' => $students, 'count' => $count, 'i' => $i, 'rooms' => $rooms]);
        }
    }

    function editStudent($sid){
        $student = DB::table("students")->find($sid);
        $rooms = DB::table("rooms")->get();
        
        $opType = "edit";
        return view("admin_views.add-student", ["student" => $student, 'opType' => $opType, "rooms" => $rooms]);
    }

    function deleteStudent($sid){
        // dd($sid);
        if($sid){
            DB::table("students")->delete($sid);

            return back()->with('success', 'Student delete successfully!');
        }
        return back()->with('error', 'Somthing went wrong while deleting student create successfully!');
    }

    function showLeftStudent(){
        $leftStudent = DB::table('students')->orderBy('id', 'desc')->where('status', '=', 'Left')->get(); 
            $rooms = DB::table("rooms")->get();

            $count = $leftStudent->count();
            $i=1;
            return view('admin_views.lefts-list', ['leftStudents' => $leftStudent, 'count' => $count, 'i' => $i, 'rooms' => $rooms]);
    }

    function showLeftStudentDtl($id){
        $student = DB::table('students')->find($id);
        $rooms = DB::table("rooms")->get();
        $i=1;
        $opType = "edit";
        // dd($student);
        return view('admin_views.remarkOnLeftStudents', ['student' => $student, 'i' => $i, 'rooms' => $rooms, 'opType' => $opType]);
    }

    function pushInLeftList($id, Request $request){
        
        DB::table("students")
            ->where('id', '=', $id)->update([
            'status' => 'left',
            'joining_date' => date('d-m-Y h:i'),
            ]);
        $students = DB::table('students')->orderBy('id', 'desc')->where('status', '=', 'Student')->get();
        $rooms = DB::table('rooms')->get();
        $count = $students->count();
        $i=1;

        // return view('admin_views.student-list', ['students' => $students, 'count' => $count, 'i' => $i, 'rooms' => $rooms])->with("success", "Student Left Successfully");
        return redirect()->route("show.manage.student")->with("worning", "Student Left Successfully");
    }
}
