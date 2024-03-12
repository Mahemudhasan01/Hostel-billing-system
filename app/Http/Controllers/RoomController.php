<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    // Rooms Function
    function showRooms(){
        return view('admin_views.add-rooms');
    }

    function showManageRoom(){
        $rooms = DB::table('rooms')->get();
        $i=1;

        return view('admin_views.room-list', ['rooms' => $rooms, 'i' => $i]);
    }

    function addRoom(Request $request){
        $msg = Validator::make($request->all(), [
            'room_name' => 'required',
            'room_fees' => 'required'
        ]);

        if($msg->fails()){
            return back()->with('errors', $msg->errors());
        }else{
            DB::table('rooms')->insert([
                'room' => $request->room_name,
                'description' => $request->room_desc,
                'fees' => $request->room_fees,
                'created_at' => date('Y-m-d')
            ]);

            return back()->with('success', "Student Add Successfuly");
        }
    }
}
