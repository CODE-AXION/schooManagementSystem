<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Http\Requests\StoreRole;


class RoleController extends Controller
{
    //

    public function allRoles()
    {
    //    $this->authorize('roles.view');

       $roles =  Role::all();

       return view('roles.index',compact('roles'));
    }


    public function create()
    {
        // $this->authorize('roles.create');

        \DB::statement("SET SQL_MODE=''");;
        $role_permission = Permission::select('name','id')->groupBy('name')->get();


        $custom_permission = array();

        foreach($role_permission as $per){

            $key = substr($per->name, 0, strpos($per->name, "."));

            if(str_starts_with($per->name, $key)){
                $custom_permission[$key][] = $per;
            }

        }

        return view('roles.create')->with('permissions',$custom_permission);
    }

    public function store(StoreRole $request)
    {

        // $this->authorize('roles.create');

        $role = Role::create([
            'name' => $request->name,
        ]);

        if($request->permissions){

            foreach ($request->permissions as $key => $value) {
                $role->givePermissionTo($value);
            }
        }


        return redirect()->route('admin.roles.all')->with('success','Role Created Successfully');
    }


    public function edit($id)
    {
        // $this->authorize('roles.edit');


        $role = Role::with('permissions')->find($id);

        \DB::statement("SET SQL_MODE=''");;
        $role_permission = Permission::select('name','id')->groupBy('name')->get();


        $custom_permission = array();

        foreach($role_permission as $per){

            $key = substr($per->name, 0, strpos($per->name, "."));

            if(str_starts_with($per->name, $key)){
                $custom_permission[$key][] = $per;
            }

        }

        return view('edit',compact('role'))->with('permissions',$custom_permission);
    }


    public function update(StoreRole $request,$id)
    {
        // $this->authorize('roles.edit');

        $role = Role::where('id',$id)->first();

        $role->update([
            "name" => $request->name
        ]);

        $role->syncPermissions($request->permissions);


        return redirect()->route('admin.roles.all')->with('success','Roles Updated Successfully');
    }


    public function delete($id)
    {
        $this->authorize('roles.delete');

        $role = Role::where('id',$id)->first();

        if(isset($role)){
            $role->permissions()->detach();
            $role->delete();

            return response()->json([
                "message" => "Role Deleted Successfully",
                "status" => true
            ],200);
        }
    }
}
