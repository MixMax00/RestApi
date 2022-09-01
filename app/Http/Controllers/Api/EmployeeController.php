<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    // EMPLOYEE ADD --POST

    public function addEmployee(Request $request)
    {
        // validation rule


        //return $request->all();


        $request->validate([
            "employee_name" => "required",
            "postion"       => "required",
            "district"      => "required",
            "country"       => "required",
            "sallery"       => "required"
        ]);

        // insert database 

        $employees = new Employee();
        $employees->employee_name = $request->employee_name;
        $employees->postion       = $request->postion;
        $employees->district      = $request->district;
        $employees->country       = $request->country;
        $employees->sallery       = $request->sallery;
        $employees->save();


        // return json response

        return response()->json([
            "status"   => true,
            "message"  => "Employee Added Successfully!!"
        ]);

    }

    // EMPLOYEE ALL VIEW  -GET

    public function all()
    {

        // all employee view

        $employees = Employee::all();


        // return all employee

        return response()->json([
            "status"   => true,
            "employee" => $employees
        ]);
        
    }

    // // EMPLOPYE SINGLE FETCH -GET

    public function single($id)
    {
        if (Employee::where('id', $id)->exists()) {
            $single_employee = Employee::find($id);

            // return single employee

            return response()->json([
                "status"   => true,
                "employee" => $single_employee
            ]);
        }else{
             return response()->json([
                "status"   => false,
                "employee" => "Employee does not exisits"
            ]);
        }
    }

    // // EMPLOYEE UPDATE - POST

    public function update(Request $request, $id)
    {

        // find employee

        if (Employee::where('id', $id)->exists()) {
            $employee = Employee::find($id);
            $employee->employee_name = isset($request->employee_name) ? $request->employee_name : $employee->employee_name;
            $employee->postion       = isset($request->postion) ? $request->postion : $employee->postion;
            $employee->district      = isset($request->district) ? $request->district : $employee->district;
            $employee->country       = isset($request->country) ? $request->country : $employee->country;
            $employee->sallery       = isset($request->sallery) ? $request->sallery : $employee->sallery;
            $employee->save();

            // return response

            return response()->json([

                "status" => true,
                "message" => "Update Employee Successfully!"
            ]);

            
        }else{
             return response()->json([
                "status"   => false,
                "employee" => "Employee does not exist"
            ]);
        }
        
    }

    // // EMPLOYEE DELETE -GET

    public function delete($id)
    {
        if (Employee::where('id',$id)->exists()) {
            $employee = Employee::find($id);
            $employee->delete();

            return response()->json([

                "status" => true,
                "message" => "Deleted Employee Successfully!",
    
            ]);
        }else {
            return response()->json([

                "status" => false,
                "message" => "Employee does not exist."
            ]);
        }
    }
}
