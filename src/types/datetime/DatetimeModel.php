<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/21/2019
 * Time: 10:51 PM
 */

namespace ersaazis\cb\types\datetime;

use ersaazis\cb\models\ColumnModel;

class DatetimeModel extends ColumnModel
{

    private $format;

    /**
     * @return mixed
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param mixed $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }
}