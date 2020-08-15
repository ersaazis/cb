<?php 
namespace ersaazis\cb\helpers;

class UserSession  {

    public function user()
    {
        return auth()->user();
    }

    public function id()
    {
        return auth()->id();
    }

    public function name()
    {
        return auth()->user()->name;
    }

    public function photo()
    {
        $user = $this->user();
        return ($user->photo)?asset($user->photo):asset(dummyPhoto());
    }

    public function roleName()
    {
        $user = $this->user();
        $role = cb()->find("cb_roles", $user->cb_roles_id);
        if($role) return $role->name;
        else return null;
    }

    public function roleId()
    {
        return $this->user()->cb_roles_id;
    }

    public function notifications($status = 0)
    {
        $notif = cb()->findAll("cb_notifications",['users_id'=>auth()->id(),'is_read'=>$status]);
        if($notif) return $notif;
        else return null;
    }

    public function countNotifications()
    {
        return count($this->notifications());
    }
}
