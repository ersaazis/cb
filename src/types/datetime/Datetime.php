<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 1/26/2019
 * Time: 6:00 PM
 */

namespace ersaazis\cb\types\datetime;

use ersaazis\cb\controllers\scaffolding\traits\DefaultOption;
use ersaazis\cb\controllers\scaffolding\traits\Join;

class Datetime
{
    use DefaultOption, Join;

    public function format($formatString = "Y-m-d H:i:s") {
        $data = columnSingleton()->getColumn($this->index);
        /**
         * @var DateModel $data
         */
        $data->setFormat($formatString);
        columnSingleton()->setColumn($this->index, $data);

        return $this;
    }

}