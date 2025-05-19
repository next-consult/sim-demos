<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ClientImport;
use App\Models\Client;
use Excel;

class ImportController extends Controller
{
public function store(Request $request){
   Client::where('email',"NULL")->update(["email"=>null]);
   Client::where('fax',"NULL")->update(["fax"=>null]);
   Client::where('mobile',"NULL")->update(["mobile"=>null]);
   Client::where('code_postal',"NULL")->update(["code_postal"=>null]);
   Client::where('mf',"NULL")->update(["mf"=>null]);
   Client::where('rne',"NULL")->update(["rne"=>null]);

}
    






}
