<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/13/2019
 * Time: 5:43 PM
 */

namespace ersaazis\cb\types\select_option;

use ersaazis\cb\types\TypesHook;

class Hook extends TypesHook
{

    /**
     * @param $row
     * @param $column SelectOptionModel
     */
    public function indexRender($row, $column)
    {
        $option = $column->getOptions();
        $key = $row->{ $column->getField() };
        return @$option[ $key ];
    }

    public function detailRender($row, $column)
    {
        return $this->indexRender($row, $column);
    }

}