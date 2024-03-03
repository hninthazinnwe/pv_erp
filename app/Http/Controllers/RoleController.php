<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            return Datatables::of(Role::orderBy('created_at', 'desc'))
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    $btn = '<button type="button" class="btn btn-secondary btnEdit mr-3" data-toggle="modal" data-target="#editModal" onclick="editData(\''.$model->uuid.'\')">Edit</button>';
                    $btn .= '<button type="button" class="btn btn-danger btnDelete" data-toggle="modal" data-target="#deleteModal" onclick="deleteData(\''.$model->uuid.'\')">Delete</button>';

                    return $btn;
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.role.index');
    }

    public function test(){
        return view('test');
    }

    public function store(Request $request){
        $validated_data = $this->validate($request, [
            "description"=>"required"
        ]);
        try{
            $role = new Role();
            $role['description'] = $validated_data['description'];
            $role['is_delete'] = false;
            $role['created_by'] = '';
            $role->save();

        }catch(Exception $e){
            return redirect()->route('roles.index')->with('error', 'Fail!');
        }

        return redirect()->route('roles.index')->with('success', 'Save Successfully!');
    }

    public function edit($uuid){
        $role = Role::where('uuid', $uuid)->first();
        return response()->json($role);
    }
     
    public function update(Request $request, $uuid){
        $validated_data = $this->validate($request, [
            "description"=>"required"
        ]);
        try{
            $role = Role::query()->where('uuid', $uuid)->first();
            if($role){
                $role->update([
                    'description' => $validated_data['description'],
                ]);
            }
        }catch(Exception $e){
            return redirect()->route('roles.index')->with('error', 'Fail!');
        }

        return redirect()->route('roles.index')->with('success', 'Update Successfully!');
    }

    public function destroy($uuid){
        $role = Role::query()->where('uuid', $uuid)->first();
        if($role){
            $role->delete();
        }else{
            return redirect()->route('roles.index')->with('error', 'Cannot find data!');
        }
        return redirect()->route('roles.index')->with('success', 'Delete Successfully!');
    }
}
