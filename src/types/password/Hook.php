<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/13/2019
 * Time: 5:43 PM
 */

namespace ersaazis\cb\types\password;

use ersaazis\cb\models\ColumnModel;
use ersaazis\cb\types\TypesHook;
use Illuminate\Support\Facades\Hash;

class Hook extends TypesHook
{
    public function assignment($value, $column)
    {
        return Hash::make($value);
    }

    public function indexRender($row, $column)
    {
        return "*****";
    }

    public function detailRender($row, $column)
    {
        return "*****";
    }

}