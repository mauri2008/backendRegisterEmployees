<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PositionModel;
use Illuminate\Support\Facades\Validator;

class Position extends Controller
{
    protected $position;

    public function __construct(PositionModel $position)
    {
        $this->position = $position;
    }

    public function index()
    {
        $positions = $this->position->all();
        return json_encode($positions);
    }

    public function show($id)
    {
        $position = $this->position->find($id);
        return view('positions.show', compact('position'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'description' => 'required|unique:positions|max:255',
        ]);

        if($validator->fails()) {
            return response()->json(['mesage'=> $validator->errors()], 422);
        }

        $this->position->description = $request->description;
        $this->position->save();

        return json_encode($this->position);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(request()->all(), [
            'description' => 'required|unique:positions|max:255',
        ]);

        if($validator->fails()) {
            return response()->json(['mesage'=> $validator->errors()], 422);
        }

        $position = $this->position->find($id);
        $position->description = $request->description;
        $position->save();

        return json_encode($position);
    }

    public function destroy($id)
    {
        $position = $this->position->find($id);
        $position->delete();

        return json_encode($position);
    }
}
