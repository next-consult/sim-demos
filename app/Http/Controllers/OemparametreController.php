<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Oemparametre;
use App\Models\Taxe;
use Validator;

class OemparametreController extends Controller
{
    public function index()
    {

        $oemparametres = Oemparametre::all();
        $taxes = Taxe::all();

        return view('oemparametres.index')
            ->with(compact('taxes'))
            ->with(compact('oemparametres'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'produit' => 'required',
                'description' => 'required',
                'prix_ht' => 'required',
                'tva' => 'required',
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        Oemparametre::create([
            "produit" => $request->produit,
            "description" => $request->description,
            "prix_ht" => $request->prix_ht,
            "tva" => $request->tva,
        ]);

        return response()->json(200);
    }

    public function one_oemparametre($id)
    {

        $oemparametre = Oemparametre::find($id);
        return response()->json($oemparametre);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'produit' => 'required',
                'description' => 'required',
                'prix_ht' => 'required',
                'tva' => 'required',
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        Oemparametre::where('id', $id)->update([
            "produit" => $request->produit,
            "description" => $request->description,
            "prix_ht" => $request->prix_ht,
            "tva" => $request->tva,
        ]);

        return response()->json(200);
    }
    public function delete($id)
    {
        Oemparametre::where('id', $id)->delete();
        return response()->json(200);
    }
}
