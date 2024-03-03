<?php
namespace App\Repositories;

use App\Models\User;
use App\Models\UserLocations;
use App\Repositories\BaseRepository;

Class UserRepository extends BaseRepository {
    protected $user;
    protected $user_locations;

    function __construct(User $user, UserLocations $user_locations)
    {
        $this->user = $user; 
        $this->user_locations = $user_locations;  
    }

    public function save($data)
    {
        // $user = new $this->user;
        // $user['name'] = $data['name'];
        // $user['role_id'] = $data['role_id'];
        // $user['email'] = $data['email'];
        // $user['password'] = '1234';
        // $user['is_delete'] = false;
        // $user['created_by'] = '';
        // dd($data);
        $created_user = User::create([
            'name' => $data['name'],
            'role_id' => $data['role_id'],
            'email' => $data['email'],
            'password' => '1234',
            'is_delete' => false,
            'created_by' => '',
        ]);
        //  $user->save();
        
        foreach($data['locations'] as $location){
            dd($created_user);
            $user_locations = new $this->user_locations;
            $user['user_uuid'] = $created_user['uuid'];
            $user['location_uuid'] = $location;
            $user_locations->save();
        }

    }
}