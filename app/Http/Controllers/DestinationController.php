<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use Session;
use Validator;
use PDF;
class DestinationController extends Controller
{
    public function index(){
    
        $destinations = Destination::all();
        return view('destinations.index')
            ->with(compact('destinations'));

    }

    public function store(Request $request)
    {
        $validator =Validator::make(
            $request->all(),
            [
                'enlevement' => 'required',
                'livraison' => 'required',
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        Destination::create([
            "enlevement" => $request->enlevement,
            "livraison" => $request->livraison,
        ]);

        return response()->json(200);
    }

    public function one_destination($id){
    
        $destination = Destination::find($id);
        return response()->json($destination );

    }

    public function update(Request $request,$id)
    {
        $validator =Validator::make(
            $request->all(),
            [
                'enlevement' => 'required',
                'livraison' => 'required',
            ],
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        Destination::where('id',$id)->update([
            "enlevement" => $request->enlevement,
            "livraison" => $request->livraison,
        ]);

        return response()->json(200);
    }


}
