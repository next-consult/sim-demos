<?php

namespace App\Http\Controllers\devise;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Devise;
use Validator;

class DeviseController extends Controller
{
    public function index()
    {

        $devises = Devise::all();
        return view('devises.index')
            ->with(compact('devises'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nom' => 'required|unique:devises,nom',
                'code' => 'required|unique:devises,code',
                'symbole' => 'required|unique:devises,symbole',
                'grande_unite' => 'required',
                'petite_unite' => 'required',
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        Devise::create([
            "nom" => $request->nom,
            "code" => $request->code,
            "symbole" => $request->symbole,
            "grande_unite" => $request->grande_unite,
            "petite_unite" => $request->petite_unite,
        ]);

        return response()->json(200);
    }

    public function one_devise($id)
    {

        $devise = Devise::find($id);
        return response()->json($devise);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nom' => 'required|unique:devises,nom,' . $id,
                'code' => 'required|unique:devises,code,' . $id,
                'symbole' => 'required|unique:devises,symbole,' . $id,
                'grande_unite' => 'required',
                'petite_unite' => 'required',
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        Devise::where('id', $id)->update([
            "nom" => $request->nom,
            "code" => $request->code,
            "symbole" => $request->symbole,
            "grande_unite" => $request->grande_unite,
            "petite_unite" => $request->petite_unite,
        ]);

        return response()->json(200);
    }
    public function delete($id)
    {
        Devise::where('id', $id)->delete();
        return response()->json(200);
    }
}
