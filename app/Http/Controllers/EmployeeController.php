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

    // handle fetch all data using ajax request
    public function fetchAll()
    {
        $emps = Employee::all();
        $output = '';
        if($emps->count() > 0)
        {
            $output .= '<table class="table table-striped table-sm text-center align-middle" id="empForm">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="select-all"></th>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Post</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>';
            foreach( $emps as $emp) 
            {
                $output .= 
                '<tr>
                    <td><input type="checkbox" name="emp[]" value="' . $emp->id . '"></td>
                    <td>'.$emp->id.'</td>
                    <td>'.$emp->first_name.' '.$emp->last_name.'</td>
                    <td>'.$emp->email.'</td>
                    <td>'.$emp->post.'</td>
                    <td>'.$emp->phone.'</td>
                    <td>
                    <a href="#" id="'.$emp->id.'" class="editIcon" data-bs-toggle="modal" data-bs-target="#editEmployeeModal"><i class="bi-pencil-square h4"></i></a>

                    <a href="#" id="'.$emp->id.'" class="text-danger mx-1 deleteIcon" ><i class="bi-trash h4"></i></a>
                    </td>
                </tr>';
            }
            $output .= '</tbody><button type="button" class="btn btn-danger" id="deleteSelected" style="margin-bottom: 10px;">Delete Selected</button></table';
            echo $output;
        } else{
            echo '<h1 class="text-center text-secondary my-5">No record present in the database</h1>';
        }
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

    public function deleteSelected(Request $request)
    {
        $ids = $request->input('emp');
        Employee::whereIn('id', $ids)->delete();
        
        return response()->json([
            'status' => 200
        ]);
    }
}
