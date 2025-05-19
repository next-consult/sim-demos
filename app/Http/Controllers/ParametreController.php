<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parametre;
use Validator;

class ParametreController extends Controller
{
    public function index()
    {
        $parametres = Parametre::all();
        return view('parametres.index')
            ->with(compact('parametres'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nb_conges' => 'required',
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        Parametre::create([
            "nb_conges" => $request->nb_conges,
        ]);
        return response()->json(200);
    }

    public function one_parametre($id)
    {
        $parametre = Parametre::find($id);
        return response()->json($parametre);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nb_conges' => 'required',
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        Parametre::where('id', $id)->update([
            "nb_conges" => $request->nb_conges,
        ]);

        return response()->json(200);
    }
    public function delete($id)
    {
        Parametre::where('id', $id)->delete();
        return response()->json(200);
    }
}
