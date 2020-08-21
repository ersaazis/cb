<?php namespace ersaazis\cb\controllers;

use Illuminate\Support\Facades\DB;

class AdminNotificationsController extends CBController
{
    use DeveloperAuthController, AuthSuspend, ForgetController, RegisterController;

    public function getRedirectNotification($id) {
        $query=DB::table('cb_notifications')->where('id',$id);
        $query->update(['is_read'=>1]);
        $url=$query->first()->url;
        return redirect($url);
    }
    public function getNotification() {
        $data = [];
        $data['notifUnRead']=cb()->session()->notifications(0);
        $data['notifRead']=cb()->session()->notifications(1);
        $data['page_title'] = "Notifikasi ".cb()->session()->name();
        return view(getThemePath('notification'), $data);
    }
    public function getReadAllNotification() {
        $query=DB::table('cb_notifications')->where('users_id',cb()->session()->id())->update(['is_read'=>1]);
        return redirect(cb()->getAdminUrl('notification'));
    }
    public function getDeleteNotification() {
        $query=DB::table('cb_notifications')->where('users_id',cb()->session()->id())->delete();
        return redirect(cb()->getAdminUrl('notification'));
    }
}
