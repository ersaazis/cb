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
use Ersaazis\CB\types\file\FileModel;

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