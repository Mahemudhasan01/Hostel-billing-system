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

    function addRoom($editId, Request $request){
        
        $msg = Validator::make($request->all(), [
            'room_name' => 'required',
            'room_fees' => 'required'
        ]);

        if($msg->fails()){
            return back()->with('error', 'Please fill all required field!.');
        }else{
            if($editId != 0){
                DB::table("rooms")
                    ->where("id", "=", $editId)
                    ->update([
                    'room' => $request->room_name,
                    'description' => $request->room_desc,
                    'fees' => $request->room_fees,
                    'created_at' => date('Y-m-d')
                ]);

                return redirect()->route('show.manage.room')->with('success', 'Room updated successfully');
            }else{
                DB::table('rooms')->insert([
                    'room' => $request->room_name,
                    'description' => $request->room_desc,
                    'fees' => $request->room_fees,
                    'created_at' => date('Y-m-d')
                ]);
                return redirect()->route('show.manage.room')->with('success', 'Room create successfully');
            }
        }
    }

    function editRoom($id){
        $room = DB::table("rooms")->find("$id");
        
        return view('admin_views.add-rooms', ['roomDtls' => $room]);
    }

    function deleteRoom($id){
        // dd($id);
        if($id){
            DB::table("rooms")->delete($id);

            return redirect()->route('show.manage.room')->with('success', 'Room delete successfully');
        }
    }
}
