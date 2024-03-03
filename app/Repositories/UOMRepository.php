<?php

namespace App\Repositories;

use App\Models\Uom;
use App\Traits\DelegatesToModels;
use Illuminate\Support\Str;

class UOMRepository extends BaseRepository {

    use DelegatesToModels;
    protected $model;

    public function __construct(Uom $uom)
    {
        $this->model = $uom;
    }

    public function save($data)
    {
        $uom = new $this->model;
        $uom['name'] = $data['name'];
        $uom['symbol'] = $data['symbol'];
        $uom['unit'] = $data['unit'];
        $uom['is_delete'] = false;
        $uom['created_by'] = '';
        $uom->save();
    }

    public function edit($id)
    {
        $customer = Uom::query()->findOrFail($id);
        if($customer){
            return $customer;
        }else{
            // return error
        }
    }

    public function update($data, $uuid)
    {
        $uom = UOM::query()->where('uuid', $uuid)->first();
        if($uom){
            $uom->update([
                'name' => $data['name'],
                'symbol' => $data['symbol'],
                'unit' => $data['unit'],
            ]);
        }else{
            return 'error-------';
        }
    }

    public function show($id)
    {
        //
    }

    public function destroy($uuid)
    {
        $uom = UOM::query()->where('uuid', $uuid)->first();
        if($uom){
            $uom->delete();
        }else{
            //return error msg
        }
    }
}