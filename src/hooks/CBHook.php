<?php 
namespace Ersaazis\CB\hooks;

interface CBHook {

    public function hookGetLogin();
	public function hookPostLogin();
	public function beforeBackendMiddleware($request);
    public function afterBackendMiddleware($request, $response);
}