<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/13/2019
 * Time: 5:43 PM
 */

namespace ersaazis\cb\types\number;

use ersaazis\cb\types\TypesHook;


class Hook extends TypesHook
{

    public function filterQuery($query, $column, $value)
    {
        $start = sanitizeXSS($value['start']);
        $end = sanitizeXSS($value['end']);
        if($start && $end) {
            $query->whereBetween($column->getFilterColumn(), [$start, $end]);
        }
        return $query;
    }

}