<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 8/12/2019
 * Time: 11:59 PM
 */

namespace ersaazis\cb\helpers;

use Illuminate\Support\Facades\Route;

class Plugin
{
    public function getAllThemes() {
        $plugins_from_user = $this->getAll();
        $plugins_from_master = $this->getAll(__DIR__."/../views/themes");
        $result = [];
        $plugins = array_merge($plugins_from_master, $plugins_from_user);
        foreach($plugins as $plugin) {
            if($plugin['type'] == "theme") {
                $result[] = $plugin;
            }
        }
        return $result;
    }

    public function getAll($path = null)
    {
        $path = ($path)?:storage_path("themes");
        $plugins = scandir($path);

        $result = [];
        foreach($plugins as $plugin) {
            if($plugin != "." && $plugin != "..") {
                $basename = basename($plugin);
                $row = json_decode(file_get_contents($path.DIRECTORY_SEPARATOR.$plugin.DIRECTORY_SEPARATOR."plugin.json"), true);
                if($row) {
                    try {
                        $row['url'] = route($basename."ControllerGetIndex");
                    } catch (\Exception $e) {
                        $row['url'] = null;
                    }
                    $result[] = $row;
                }
            }
        }

        $result = collect($result)->sortBy("name")->values()->all();

        return $result;
    }
}