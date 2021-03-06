<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 1/26/2019
 * Time: 6:00 PM
 */

namespace ersaazis\cb\types\number;

use ersaazis\cb\controllers\scaffolding\traits\DefaultOption;
use ersaazis\cb\controllers\scaffolding\traits\Join;
use ersaazis\cb\types\number\NumberModel;

class Number
{
    use DefaultOption, Join;

    public function max($max)
    {
        $data = columnSingleton()->getColumn($this->index);
        /** @var NumberModel $data */
        $data->setMax($max);
        columnSingleton()->setColumn($this->index, $data);

        return $this;
    }

    public function min($min)
    {
        $data = columnSingleton()->getColumn($this->index);
        /** @var NumberModel $data */
        $data->setMin($min);
        columnSingleton()->setColumn($this->index, $data);

        return $this;
    }

    public function step($step)
    {
        $data = columnSingleton()->getColumn($this->index);
        /** @var NumberModel $data */
        $data->setStep($step);
        columnSingleton()->setColumn($this->index, $data);

        return $this;
    }

}