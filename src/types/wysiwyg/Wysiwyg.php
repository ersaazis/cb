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
use Ersaazis\CB\types\wysiwyg\WysiwygModel;

class Wysiwyg
{
    use DefaultOption, Join;


    public function strLimit($length = 100) {
        $data = columnSingleton()->getColumn($this->index);
        /** @var WysiwygModel $data */
        $data->setLimit($length);

        columnSingleton()->setColumn($this->index, $data);

        return $this;
    }

}