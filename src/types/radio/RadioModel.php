<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/21/2019
 * Time: 10:51 PM
 */

namespace ersaazis\cb\types\radio;

use ersaazis\cb\models\ColumnModel;

class RadioModel extends ColumnModel
{

    private $options;

    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param mixed $options
     */
    public function setOptions($options): void
    {
        $this->options = $options;
    }


}