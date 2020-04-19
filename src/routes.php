<?php

// Developer Backend Middleware
Route::group(['middleware' => ['web',\ersaazis\cb\middlewares\CBDeveloper::class],
    'prefix'=>"developer/".getSetting('developer_path'),
    'namespace' => 'ersaazis\cb\controllers'], function () {
    cb()->routeController("modules", '\ersaazis\cb\controllers\DeveloperModulesController');
    cb()->routeController("menus", '\ersaazis\cb\controllers\DeveloperMenusController');
    cb()->routeController("roles",'\ersaazis\cb\controllers\DeveloperRolesController');
    cb()->routeController("users",'\ersaazis\cb\controllers\DeveloperUsersController');
    cb()->routeController("mail",'\ersaazis\cb\controllers\DeveloperMailController');
    cb()->routeController("security",'\ersaazis\cb\controllers\DeveloperSecurityController');
    cb()->routeController("themes",'\ersaazis\cb\controllers\DeveloperThemesController');
    cb()->routeController("appearance",'\ersaazis\cb\controllers\DeveloperAppearanceController');
    cb()->routeController("miscellaneous",'\ersaazis\cb\controllers\DeveloperMiscellaneousController');
    cb()->routePost("skip-tutorial","DeveloperDashboardController@postSkipTutorial");
    cb()->routeGet("/","DeveloperDashboardController@getIndex");
});

// Developer Auth Middleware
Route::group(['middleware' => ['web'],
    'prefix'=>"developer/".getSetting('developer_path'),
    'namespace' => 'ersaazis\cb\controllers'], function () {
    cb()->routePost("login","AdminAuthController@postLoginDeveloper");
    cb()->routeGet("login","AdminAuthController@getLoginDeveloper");
    cb()->routeGet("logout","AdminAuthController@getLogoutDeveloper");
});

// Routing without any middleware
Route::group(['middleware' => ['web'], 'namespace' => '\ersaazis\cb\controllers'], function () {
    if(getSetting("AUTO_REDIRECT_TO_LOGIN")) {
        cb()->routeGet("/","AdminAuthController@getRedirectToLogin");
    }
});

// Routing without any middleware with admin prefix
Route::group(['middleware' => ['web'], 'prefix' => cb()->getAdminPath(), 'namespace' => 'ersaazis\cb\controllers'], function () {
    cb()->routeGet('logout', "AdminAuthController@getLogout");

    if(!getSetting("DISABLE_LOGIN")) {
        cb()->routePost('login', "AdminAuthController@postLogin");
        cb()->routeGet('login', "AdminAuthController@getLogin");
        cb()->routeGet("login-verification","AdminAuthController@getLoginVerification");
        cb()->routePost("submit-login-verification","AdminAuthController@postSubmitLoginVerification");
    }

    if(getSetting("enable_forget")) {
        cb()->routePost("forget","AdminAuthController@postForget");
        cb()->routeGet("continue-reset/{token}","AdminAuthController@getContinueReset");
    }

    if(getSetting("enable_register")) {
        cb()->routePost("register","AdminAuthController@postRegister");
        cb()->routeGet("continue-register/{token}","AdminAuthController@postContinueRegister");
    }
});

// Routing package controllers
cb()->routeGroupBackend(function () {
    cb()->routeController('profile', '\ersaazis\cb\controllers\AdminProfileController');
});

// Auto Routing for App\Http\Controllers
Route::group([
    'middleware' => ['web', \ersaazis\cb\middlewares\CBBackend::class],
    'prefix' => cb()->getAdminPath(),
    'namespace' => 'App\Http\Controllers',
], function () {

    if (Request::is(cb()->getAdminPath())) {
        if($dashboard = getSetting("dashboard_controller")) {
            cb()->routeGet("/", $dashboard."@getIndex");
        }else{
            cb()->routeGet("/", '\ersaazis\cb\controllers\AdminDashboardController@getIndex');
        }
    }

    $controllers = glob(app_path('Http/Controllers/Admin*Controller.php'));

    foreach($controllers as $controller) {
        $controllerName = basename($controller);
        $controllerName = rtrim($controllerName,".php");
        $className = '\App\Http\Controllers\\'.$controllerName;
        $controllerClass = new $className();
        if(method_exists($controllerClass, 'cbInit')) {
            cb()->routeController($controllerClass->getData('permalink'), $controllerName);
        }
    }
});
