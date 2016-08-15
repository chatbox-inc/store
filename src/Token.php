<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/03/03
 * Time: 2:14
 */

namespace Chatbox\Token;

use Carbon\Carbon;

class Token implements \JsonSerializable
{
    public $key;

    public $value;

    public $createdAt;

    /**
     * Token constructor.
     * @param $key
     * @param $value
     * @param $createdAt
     */
    public function __construct(string $key, $value,Carbon $createdAt = null)
    {
        $this->key = $key;
        $this->value = $value;
        $this->createdAt = $createdAt;
    }

    function jsonSerialize()
    {
        return (array)$this;
    }


}