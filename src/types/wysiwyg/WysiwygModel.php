<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/21/2019
 * Time: 10:51 PM
 */

namespace Ersaazis\CB\types\wysiwyg;

use Ersaazis\CB\models\ColumnModel;

class WysiwygModel extends ColumnModel
{
    private $limit;

    /**
     * @return mixed
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param mixed $limit
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
    }
}