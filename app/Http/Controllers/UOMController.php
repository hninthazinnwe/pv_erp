<?php

namespace App\Http\Controllers;

use App\Http\Requests\UOMCreateRequest;
use App\Models\UOM;
use Illuminate\Http\Request;
use App\Repositories\UOMRepository;
use Datatables;
use Exception;

class UOMController extends Controller
{
    private $uom;

    public function __construct(UOMRepository $uom)
    {
        $this->uom = $uom;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(UOM::orderBy('created_at', 'desc'))
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    $btn = '<button type="button" class="btn btn-secondary btnEdit mr-3" data-toggle="modal" data-target="#editModal" onclick="editData(\''.$model->uuid.'\')">Edit</button>';
                    $btn .= '<button type="button" class="btn btn-danger btnDelete" data-toggle="modal" data-target="#deleteModal" onclick="deleteData(\''.$model->uuid.'\')">Delete</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('backend.uom.index');
    }

    public function create()
    {
        return view('backend.uom.create');
    }
    public function show($uuid)
    {
        $uom = UOM::where('uuid', $uuid)
                  ->where('is_delete', false)
                  ->first();
        return response()->json($uom);
    }

    public function edit($uuid)
    {
        // if (!auth()->user()->can(EDIT_CUSTOMER)) {
        //     abort(403);
        // }
        $uom = UOM::where('uuid', $uuid)
                  ->where('is_delete', false)
                  ->first();
        return response()->json($uom);
    }

    public function store(UOMCreateRequest $request)
    {
        $validated_data = $request->validated();
        try{
            $this->uom->save($validated_data);
        }catch(Exception $e){
            return redirect()->route('uoms.index')->with('error', 'Create Fail!');
        }
        return redirect()->route('uoms.index')->with('success', 'Save Successfully!');
    }

    public function update(UOMCreateRequest $request, $uuid)
    {
        try{
            $validated_data = $request->validated();
            $this->uom->update($validated_data, $uuid);
        }catch(Exception $e){
            return redirect()->route('uoms.index')->with('error', 'Update Fail!');
        }
        return redirect()->route('uoms.index')->with('success', 'Update Successfully!');
    }

    public function destroy($uuid){
        try{
            $this->uom->destroy($uuid);
        }catch(Exception $e){
            return redirect()->route('uoms.index')->with('error', 'Delete Fail!');
        }
        return redirect()->route('uoms.index')->with('success', 'Delete Successfully!');
    }
}
