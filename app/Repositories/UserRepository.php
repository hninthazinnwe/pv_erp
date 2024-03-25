<?php
namespace App\Repositories;

use App\Models\User;
use App\Models\UserLocations;
use App\Repositories\BaseRepository;
use App\Traits\DelegatesToModels;

Class UserRepository extends BaseRepository {
    // use DelegatesToModels;
    protected $user;
    protected $user_locations;

    public function __construct(User $user, UserLocations $user_locations)
    {
        $this->user = $user; 
        $this->user_locations = $user_locations;  
    }

    public function save($data)
    {
        $this->user->name = $data['name'];
        $this->user->role_id = $data['role_id'];
        $this->user->email = $data['email'];
        $this->user->password = 1234;
        $this->user->is_delete = false;
        $this->user->created_by = '';
        $this->user->save();
        foreach($data['locations'] as $location){
            $user_locations = new $this->user_locations;
            $user_locations->user_uuid = $this->user['uuid'];
            $user_locations->location_uuid = $location;
            $user_locations->created_by = '';
            $user_locations->save();
        }
    }

    public function update($data, $uuid){
        $user = User::with('user_locations')->where('uuid', $uuid)->first();
        if($user){
            $user->update([
                'name' => $data['name'],
                'role_id' => $data['role_id'],
                'email' => $data['email'],
            ]);

            $user->user_locations()->delete();
            if(count($data['locations']) > 0){
                foreach($data['locations'] as $location){
                    $user_locations = new $this->user_locations;
                    $user_locations->user_uuid = $uuid;
                    $user_locations->location_uuid = $location;
                    $user_locations->created_by = '';
                    $user_locations->save();
                }
            }
        }else{
            return 'error-------';
        }
    }

    public function destroy($uuid){
        $user = User::with('user_locations')->where('uuid', $uuid)->first();
        if($user){
            $user->delete();
            $user->user_locations->delete();
        }else{
            //return error msg
        }
    }
}