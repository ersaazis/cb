<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 1/26/2019
 * Time: 6:00 PM
 */

namespace ersaazis\cb\types\text_area;

use ersaazis\cb\controllers\scaffolding\traits\DefaultOption;
use ersaazis\cb\controllers\scaffolding\traits\Join;

class TextArea
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