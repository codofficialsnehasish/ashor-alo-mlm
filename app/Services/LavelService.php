<?php
namespace App\Services;

use App\Models\User;

class LavelService
{
    // public function update_lavel($user_id){
    //     $user = User::where('user_id',$user_id)->first();
    //     if((!empty($user_id) && !empty($user)) || $user->lavel == 1){
    //         return;
    //     }

    //     $user->lavel += 1;
    //     $user->update();
    //     update_lavel($user->agent_id);
    // }

    public function update_level($user_id, $count = 0) {
        $user = User::where('user_id', $user_id)->first();
        if (empty($user)) {
            return;
        }
        $is_lavel_updated = 0;
        //for direct joining
        $userCount = User::where('agent_id', $user->user_id)->count();
        if($userCount > 1 && $count == 0){
            return;
        }else{
            $user->lavel += 1;
            $user->save();
            $is_lavel_updated = 1;
        }


        $max_level = User::where('agent_id', $user->agent_id)->where('user_id','!=',$user->user_id)->max('lavel');
        if($max_level < $user->lavel){
            if (!empty($user->agent_id) && $is_lavel_updated) {
                $this->update_level($user->agent_id, $count+=1);
            }
        }

    }

    // public function update_level($user_id) {
    //     $user = User::where('user_id', $user_id)->first();
    
    //     if (empty($user) || empty($user_id)) {
    //         return;
    //     }
    
    //     $new_level = $user->lavel + 1;
    //     $user->lavel = $new_level;
    //     $user->save();
    
    //     // Update levels for all agents in the chain
    //     $current_user = $user;
    //     while (!empty($current_user->agent_id)) {
    //         $agent = User::where('user_id', $current_user->agent_id)->first();
    //         if ($agent->lavel <= $current_user->lavel) {
    //             $agent->lavel = $current_user->lavel + 1;
    //             $agent->save();
    //         }
    //         $current_user = $agent;
    //     }
    // }
    
    
}