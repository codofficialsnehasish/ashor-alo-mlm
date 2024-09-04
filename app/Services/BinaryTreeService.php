<?php
namespace App\Services;

use App\Models\User;
use App\Services\LavelService;

class BinaryTreeService
{
    protected $lavelservice;

    public function __construct(LavelService $lavelservice){
        $this->lavelservice = $lavelservice;
    }

    public function findDeepestLeftChild($userId)
    {
        $user = User::find($userId);
        while ($user && $user->children->where('is_left', 1)->count() > 0) {
            $user = $user->children->where('is_left', 1)->first();
        }
        return $user;
    }

    public function findDeepestRightChild($userId)
    {
        $user = User::find($userId);
        while ($user && $user->children->where('is_right', 1)->count() > 0) {
            $user = $user->children->where('is_right', 1)->first();
        }
        return $user;
    }

    public function addUser($userData)
    {
        if(!empty($userData['agentid'])){
            $agent = User::where('user_id',$userData['agentid'])->first();
            if (!$agent) {
                throw new \Exception('Agent not found');
            }
    
            if ($userData['position'] == 'left') {
                $deepestLeftChild = $this->findDeepestLeftChild($agent->id);
                $userData['parent_id'] = $deepestLeftChild->id;
            } elseif ($userData['position'] == 'right') {
                $deepestRightChild = $this->findDeepestRightChild($agent->id);
                $userData['parent_id'] = $deepestRightChild->id;
            }
        }
        // return 'ok';
        // return User::create($userData);


        $obj = new User();
        $obj->user_id = generate_agent_id();
        $obj->agent_id = $userData['agentid'] ? $userData['agentid'] : null;
        $obj->name = $userData['membername'];
        if($userData['position'] == 'left'){
            $obj->is_left = 1;
        }
        if($userData['position'] == 'right'){
            $obj->is_right = 1;
        }
        if(!empty($userData['parent_id'])){
            $obj->parent_id = $userData['parent_id'];
        }
        $obj->status = 0;
        $obj->role = "agent";
        $obj->email = $userData['email'];
        $obj->phone = $userData['mobile'];
        // $obj->password  = bcrypt($userData['password']);
        $auto_generate_password = generate_random_password();
        $obj->password  = bcrypt($auto_generate_password);
        $obj->decoded_password = $auto_generate_password;
        $obj->token = generateToken();
        $res = $obj->save();
        if(!empty($userData['agentid'])){
            $user = $this->lavelservice->update_level($userData['agentid']);
        }
        return $obj;
    }
}
