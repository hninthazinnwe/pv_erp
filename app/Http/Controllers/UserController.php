<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Location;
use App\Models\Role;
use DataTables;
use App\Models\User;
use App\Repositories\UserRepository;
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
            return Datatables::of(User::with('role', 'user_locations')->orderBy('created_at', 'desc'))
                ->addIndexColumn()
                ->addColumn('role', function ($model) {
                    if ($model->role()->exists()) {
                        return  $model->role->description;
                    } else {
                        return '-';
                    }
                })
                ->addColumn('location', function ($model) {
                    if ($model->user_locations()->exists()) {
                        $loc="";
                        foreach($model->user_locations as $location){
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

        $roles = Role::all();
        $locations = Location::all();
        return view('backend.user.index', compact('roles','locations'));
    }

    public function create(){

    }

    public function store(UserRequest $request){
        $validated_data = $request->validated();
        // dd($validated_data);
        // $validated_data['password'] = 1234;
        // $validated_data['is_delete'] = false;
        // $validated_data['created_by'] = '';
        // $user = $this->user->create($validated_data);
        // dd($user);
        $this->user->save($validated_data);
        return redirect()->route('users.index')->with('success', 'Save Successfully!');
    }

    public function edit(){

    }

    public function update(){
        
    }

    public function destroy(){
        
    }
}
