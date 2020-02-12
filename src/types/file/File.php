<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 1/26/2019
 * Time: 6:00 PM
 */

namespace ersaazis\cb\types;

use ersaazis\cb\controllers\scaffolding\traits\DefaultOption;
use ersaazis\cb\controllers\scaffolding\traits\Join;
use ersaazis\cb\types\file\FileModel;

class File
{
    use DefaultOption, Join;

    public function encrypt($boolean)
    {
        /**
         * @var FileModel $data
         */
        $data = columnSingleton()->getColumn($this->index);
        $data->setEncrypt($boolean);
        columnSingleton()->setColumn($this->index, $data);
        return $this;
    }
}