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
            return Datatables::of(User::orderBy('created_at', 'desc'))
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    $btn = '<button type="button" class="btn btn-secondary btnEdit mr-3" data-toggle="modal" data-target="#editModal" onclick="editData(\''.$model->uuid.'\')">Edit</button>';
                    $btn .= '<button type="button" class="btn btn-danger btnDelete" data-toggle="modal" data-target="#deleteModal" onclick="deleteData(\''.$model->uuid.'\')">Delete</button>';

                    return $btn;
                })

                ->rawColumns(['action'])
                ->make(true);
        }

        $roles = Role::all();
        $locations = Location::get();
        return view('backend.user.index', compact('roles','locations'));
    }

    public function create(){

    }

    public function store(UserRequest $request){
        $validated_data = $request->validated();
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
