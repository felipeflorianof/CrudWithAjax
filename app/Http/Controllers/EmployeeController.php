<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    // handle insert employee with ajax request
    public function store(Request $request)
    {
     
        $empData = [
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'email' => $request->email,
            'phone' => $request->phone,
            'post' => $request->post,
        ];

        Employee::create($empData);
        return response()->json([
            'status' => 200
        ]);
    }

    // Responsible for fetching all the employee records from the database and returning them in JSON format.
    public function fetchAll()
    {
        $emps = Employee::all();
        return response()->json([
            'emps' => $emps,
        ]);
    }

    // handle edit employee ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Employee::find($id);
        return response()->json($emp);
    }

    // handle update employee with ajax request
    public function update(Request $request)
    {
        
        $emp = Employee::find($request->emp_id);
    
        $empData = [
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'email' => $request->email,
            'phone' => $request->phone,
            'post' => $request->post,
           
        ];
        $emp->update($empData);
        return response()->json([
            'status' => 200
        ]);
    }

    // handle delete employee with ajax request
    public function delete(Request $request)
    {
        $id = $request->id;
        $emp = Employee::find($id);
        Employee::destroy($id);
    }

    // handle the multiple delete with ajax
    public function deleteSelected(Request $request)
    {
        $ids = $request->input('emp');
        Employee::whereIn('id', $ids)->delete();
        
        return response()->json([
            'status' => 200
        ]);
    }
}
