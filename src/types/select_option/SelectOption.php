<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 1/26/2019
 * Time: 6:00 PM
 */

namespace Ersaazis\CB\types;

use Ersaazis\CB\controllers\scaffolding\traits\DefaultOption;
use Ersaazis\CB\controllers\scaffolding\traits\Join;
use Ersaazis\CB\models\ColumnModel;
use Ersaazis\CB\types\select_option\SelectOptionModel;
use Illuminate\Support\Facades\DB;

class SelectOption
{
    use DefaultOption, Join;

    public function options($data_options) {
        $data = columnSingleton()->getColumn($this->index);

        foreach($data_options as $key=>$option) {
            if(is_int($key)) {
                $data_options[$option] = $option;
            }else{
                $data_options[$key] = $option;
            }
        }

        /** @var $data SelectOptionModel */
        $data->setOptions($data_options);

        columnSingleton()->setColumn($this->index, $data);

        return $this;
    }
}