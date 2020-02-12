<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/25/2019
 * Time: 9:28 PM
 */

namespace ersaazis\cb\controllers;


use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class DeveloperDashboardController extends Controller
{

    public function getIndex() {
        $data = [];
        $data['page_title'] = "Dashboard";
        return view('crud::dev_layouts.modules.dashboard',$data);
    }
    
    public function postSkipTutorial()
    {
        Cache::forever("skip_developer_tutorial", request("status"));
        return response()->json(['status'=>true]);
    }
}