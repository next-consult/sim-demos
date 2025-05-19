<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use App\Models\RolePermission;

class RolesController extends Controller
{
    public function index(){
            
        $roles = Role::all();
        return view('roles.index')
            ->with(compact('roles'));
    }
    public function create(){
        $permissions = Permission::all();
        return view('roles.add')
            ->with(compact('permissions'));
    }
    public function store(Request $request){
        $modules=json_decode($request->modules);
        $role=Role::create(["nom"=>$request->nom]);
        foreach($modules as $module)
        {
            RolePermission::create([
            "role_id"=>$role->id,
            "permission_id"=>$module,
         ]);    
        }
        return response()->json(200);

    }
    public function update($id){
        $permissions = Permission::all();
        $role = Role::find($id);
        return view('roles.update')
          ->with(compact('role'))
          ->with(compact('permissions'));
    }
    public function update_store(Request $request,$id){
        $modules=json_decode($request->modules);
        $role=Role::find($id);
        $role->nom=$request->nom;
        $role->update();
        RolePermission::whereNotIn('permission_id',$modules)->where('role_id',$id)->delete();                           
        foreach($modules as $module)
        {
        $test=RolePermission::where('permission_id',$module)->where('role_id',$id)->exists();
        if($test==false){
            RolePermission::create([
                "role_id"=>$id,
                "permission_id"=>$module,
             ]);
        }
        }
        return response()->json(200);

    }
    public function delete($id){
        $role=Role::find($id);
        $user=User::where('role_id',$id)->exists();
        if($user==true){
          return response()->json(-1);
        }
        $role->delete();
        return response()->json(200);

    }
}
