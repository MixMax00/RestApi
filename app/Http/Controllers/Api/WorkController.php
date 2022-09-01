<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Work;

class WorkController extends Controller
{
   // WORK ADD --POST

    public function add(Request $request)
    {
        // validation rule

        $request->validate([
            "employee_name" => "required",
            "work_title"       => "required",
            "desciption"      => "required",
            "start_date"       => "required",
            "end_date"       => "required"
        ]);

        // insert database 

        $works = new Work();
        $works->employee_name   = json_encode($request->employee_name);
        $works->work_title      = $request->work_title;
        $works->desciption      = $request->desciption;
        $works->start_date      = $request->start_date;
        $works->end_date        = $request->end_date;
        $works->save();


        // return json response

        return response()->json([
            "status"   => true,
            "message"  => "Work Added Successfully!!"
        ]);

    }

    // WORK ALL VIEW  -GET

    public function all()
    {
        
        $works = Work::all();


        // return all employee

        return response()->json([
            "status"   => true,
            "employee" => $works
        ]);
    }

    // WORK SINGLE FETCH -GET

    public function single($id)
    {
        if (Work::where('id', $id)->exists()) {
            $single_work = Work::find($id);

            // return single work

            return response()->json([
                "status"   => true,
                "employee" => $single_work
            ]);
        }else{
             return response()->json([
                "status"   => false,
                "employee" => "Employee does not exisits"
            ]);
        }
    }

    // WORK UPDATE - POST

    public function update(Request $request, $id)
    {
        // find work

        if (Work::where('id', $id)->exists()) {

            $employee = Employee::find($id);
            $employee->employee_name = json_encode(isset($request->employee_name) ? $request->employee_name : $employee->employee_name);
            $employee->work_title       = isset($request->work_title) ? $request->work_title : $employee->work_title;
            $employee->desciption      = isset($request->desciption) ? $request->desciption : $employee->desciption;
            $employee->start_date       = isset($request->start_date) ? $request->start_date : $employee->start_date;
            $employee->end_date       = isset($request->end_date) ? $request->end_date : $employee->end_date;
            $employee->save();

            // return response

            return response()->json([

                "status" => true,
                "message" => "Update Work Successfully!"
            ]);

            
        }else{
             return response()->json([
                "status"   => false,
                "Work" => "Work does not exist"
            ]);
        }
    }

    // WORK DELETE -GET

    public function delete()
    {

        if (Work::where('id',$id)->exists()) {
            $work = Work::find($id);
            $work->delete();

            return response()->json([

                "status" => true,
                "message" => "Deleted Work Successfully!",
    
            ]);
        }else {
            return response()->json([

                "status" => false,
                "message" => "Work does not exist."
            ]);
        }
        
    }
}
