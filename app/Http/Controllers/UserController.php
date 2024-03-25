<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Location;
use App\Models\Role;
use DataTables;
use App\Models\User;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $user;
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }
    public function index(Request $request){
        if ($request->ajax()) {
            return Datatables::of(User::with('role', 'locations')->orderBy('created_at', 'desc'))
                ->addIndexColumn()
                ->addColumn('role', function ($model) {
                    if ($model->role()->exists()) {
                        return  $model->role->description;
                    } else {
                        return '-';
                    }
                })
                ->addColumn('location', function ($model) {
                    if ($model->locations()->exists()) {
                        $loc="";
                        foreach($model->locations as $location){
                            $loc .= $location->name . ', ';
                        }
                        return  $loc;
                    } else {
                        return '-';
                    }
                })
                ->addColumn('action', function ($model) {
                    $btn = '<button type="button" class="btn btn-secondary btnEdit mr-3" data-toggle="modal" data-target="#editModal" onclick="editData(\''.$model->uuid.'\')">Edit</button>';
                    $btn .= '<button type="button" class="btn btn-danger btnDelete" data-toggle="modal" data-target="#deleteModal" onclick="deleteData(\''.$model->uuid.'\')">Delete</button>';

                    return $btn;
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        $users = User::with('role', 'locations')->orderBy('created_at', 'desc')->get();
        $roles = Role::all();
        $locations = Location::all();
        return view('backend.user.index', compact('roles','locations', 'users'));
    }

    public function create(){

    }

    public function store(UserRequest $request){
        $validated_data = $request->validated();
        $this->user->save($validated_data);
        return redirect()->route('users.index')->with('success', 'Save Successfully!');
    }

    public function edit($uuid){
        $uom = User::with('role', 'locations')->where('uuid', $uuid)
            ->where('is_delete', false)
            ->first();
        return response()->json($uom);
    }

    public function update(UserRequest $request, $uuid){
        $validated_data = $request->validated();
        $this->user->update($validated_data, $uuid);
        return redirect()->route('users.index')->with('success', 'Update Successfully!');
    }

    public function destroy($uuid){
        try{
            $this->user->destroy($uuid);
        }catch(Exception $e){
            return redirect()->route('users.index')->with('error', 'Delete Fail!');
        }
        return redirect()->route('users.index')->with('success', 'Delete Successfully!');
    }
}
