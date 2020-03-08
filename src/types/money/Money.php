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
use ersaazis\cb\types\money\MoneyModel;

class Money
{
    use DefaultOption, Join;

    public function prefix($prefix) {
        $data = columnSingleton()->getColumn($this->index);
        /** @var $data MoneyModel */
        $data->setPrefix($prefix);
        columnSingleton()->setColumn($this->index, $data);
        return $this;
    }

    public function precision($precision) {
        $data = columnSingleton()->getColumn($this->index);
        /** @var $data MoneyModel */
        $data->setPrecision($precision);
        columnSingleton()->setColumn($this->index, $data);
        return $this;
    }

    public function thousandSeparator($separator) {
        $data = columnSingleton()->getColumn($this->index);
        /** @var $data MoneyModel */
        $data->setThousands($separator);
        columnSingleton()->setColumn($this->index, $data);
        return $this;
    }

    public function decimalSeparator($separator) {
        $data = columnSingleton()->getColumn($this->index);
        /** @var $data MoneyModel */
        $data->setDecimal($separator);
        columnSingleton()->setColumn($this->index, $data);
        return $this;
    }
}