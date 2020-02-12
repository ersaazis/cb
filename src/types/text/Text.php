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
use ersaazis\cb\types\text\TextModel;

class Text
{
    use DefaultOption, Join;

    public function strLimit($length = 100) {
        $data = columnSingleton()->getColumn($this->index);
        /** @var WysiwygModel $data */
        $data->setLimit($length);

        columnSingleton()->setColumn($this->index, $data);

        return $this;
    }

    public function maxLength($length) {
        $model = columnSingleton()->getColumn($this->index);
        /**
         * @var TextModel $model
         */
        $model->setMaxLength($length);
        columnSingleton()->setColumn($this->index, $model);
    }

    public function minLength($length) {
        $model = columnSingleton()->getColumn($this->index);
        /**
         * @var TextModel $model
         */
        $model->setMinLength($length);
        columnSingleton()->setColumn($this->index, $model);
    }
}