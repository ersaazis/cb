<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/13/2019
 * Time: 5:43 PM
 */

namespace ersaazis\cb\types\checkbox;

use ersaazis\cb\models\ColumnModel;
use ersaazis\cb\types\TypesHook;

class Hook extends TypesHook
{
    /**
     * @param $value
     * @param CheckboxModel $column
     * @return mixed|string
     */
    public function assignment($value, $column)
    {
        return @implode(";", request( $column->getName() ));
    }

}