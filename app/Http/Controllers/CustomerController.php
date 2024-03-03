<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerCreateRequest;
use App\Repositories\CustomerRepository;
use App\Models\Customer;
use Datatables;
use Exception;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $customer;

    public function __construct(CustomerRepository $customer)
    {
        $this->customer = $customer;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Customer::orderBy('created_at', 'desc'))
                ->addIndexColumn()
                ->addColumn('action', function ($model) {

                    $btn = '<button type="button" class="btn btn-secondary btnEdit mr-3" data-toggle="modal" data-target="#editModal" onclick="editData(\''.$model->uuid.'\')">Edit</button>';
                    $btn .= '<button type="button" class="btn btn-danger btnDelete" data-toggle="modal" data-target="#deleteModal" onclick="deleteData(\''.$model->uuid.'\')">Delete</button>';
                    
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $customer = null;
        return view('backend.customer.index', compact('customer'));
    }

    public function create()
    {
        return view('backend.customer.create');
    }

    public function store(CustomerCreateRequest $request)
    {
        $validated_data = $request->validated();
        try{
            $this->customer->save($validated_data);
        }catch(Exception $e){
            return redirect()->route('customers.index')->with('error', 'Fail!');
        }

        return redirect()->route('customers.index')->with('success', 'Save Successfully!');
    }

    public function edit($uuid)
    {
        $customer = $this->customer->edit($uuid);
        return response()->json($customer);
    }

    public function update($id,CustomerCreateRequest $request)
    {
        $validated_data = $request->validated();
        try{
            $this->customer->update($validated_data, $id);
        }catch(Exception $e){
            return redirect()->route('customers.index')->with('error', 'Fail!');
        }
       
        return redirect()->route('customers.index')->with('success', 'Update Successfully!');
    }

    public function destroy($uuid){
        try{
            $this->customer->destroy($uuid);
        }catch(Exception $e){
            return redirect()->route('customers.index')->with('error', 'Fail!');
        }
        return redirect()->route('customers.index')->with('success', 'Delete Successfully!');
    }
}
