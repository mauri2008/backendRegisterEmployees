<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeModel;
use Illuminate\Support\Facades\Validator;

class Employee extends Controller
{
    protected $employee;

    public function __construct(EmployeeModel $employee)
    {
        $this->employee = $employee;
    }
    

    public function index()
    {
        $employee =$this->employee->select('employees.*','positions.description');
        $employee->join('positions', 'employees.id_position', '=', 'positions.id');
        $employees = $employee->get();
        return json_encode($employees);
    }

    public function show($id)
    {
        $queryemployee =$this->employee->select('employees.*','positions.description');
        $queryemployee->join('positions', 'employees.id_position', '=', 'positions.id');
        $employee = $queryemployee->find($id);
        return json_encode($employee);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'id_position' => 'required|integer',
            'lastname' => 'required|string|max:255',
            'birthdate' => 'required|string|max:255',
            'wage' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $this->employee->name = $request->name;
        $this->employee->lastname = $request->lastname;
        $this->employee->birthdate = $request->birthdate;
        $this->employee->wage = $request->wage;
        $this->employee->id_position= $request->id_position;
        $this->employee->save();

        return json_encode($this->employee);
    }

    public function update(Request $request, $id)
    {
        if(!$this->employee->find($id)){
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'id_position' => 'required|integer',
            'lastname' => 'required|string|max:255',
            'birthdate' => 'required|string|max:255',
            'wage' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }   

        $this->employee->name = $request->name;
        $this->employee->lastname = $request->lastname;
        $this->employee->birthdate = $request->birthdate;
        $this->employee->wage = $request->wage;
        $this->employee->id_position = $request->id_position;
        $this->employee->save();

        return json_encode($this->employee);
    }

    public function destroy($id)
    {
        $this->employee->destroy($id);
        return json_encode($this->employee);
    }
}
