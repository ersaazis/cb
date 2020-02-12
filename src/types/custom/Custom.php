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

class Custom
{
    use DefaultOption, Join;

    /**
     * @param $html string
     * @return $this
     */
    public function setHtml($html) {
        $data = columnSingleton()->getColumn($this->index);
        $data->setHtml($html);
        columnSingleton()->setColumn($this->index, $data);
        return $this;
    }

}