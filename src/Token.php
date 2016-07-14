<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/03/03
 * Time: 2:14
 */

namespace Chatbox\Token;

class Token
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
    public function __construct(string $key, $value, $createdAt = null)
    {
        $this->key = $key;
        $this->value = $value;
        $this->createdAt = $createdAt;
    }
}