<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/25/2019
 * Time: 9:28 PM
 */

namespace ersaazis\cb\controllers;


use ersaazis\cb\exceptions\CBValidationException;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Support\Facades\DB;

class DeveloperAppearanceController extends Controller
{
    private $view = "crud::dev_layouts.modules.appearance";

    public function __construct()
    {
        view()->share(['page_title'=>'Appearance']);
    }

    public function getIndex() {
        $data = [];
        return view($this->view.".index",$data);
    }

    public function postSave()
    {
        foreach(request()->except("_token") as $key=>$val) {
            putSetting( $key,  $val);
        }

        if(request("login_background_cover")) {
            putSetting("login_background_cover", "on");
        } else {
            putSetting("login_background_cover", "");
        }

        return cb()->redirectBack("Appearance has been updated!","success");
    }
}