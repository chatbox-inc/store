<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/14
 * Time: 17:56
 */

namespace Chatbox\Token\Storage\DB;

use Chatbox\Token\Token;

class TaggableDB extends SimpleDB
{
    use TaggableTokenDBTrait;

    protected $tag;

    public function __construct($tag="tokentag")
    {
        $this->tag = $tag;
    }

    public function copy($tag){
        return new static($tag);
    }

    public function saveToken($value, $key = null):Token
    {
        return $this->_saveToken([
            "key" => $key ?: $this->ramdomKey(),
            "value" => $this->serialize($value),
            "tag" => $this->tag
        ]);
    }

    public function loadToken($key):Token
    {
        return $this->_loadToken([
            "key" => $key,
            "tag" => $this->tag
        ]);
    }

    public function deleteToken($key)
    {
        return $this->_deleteToken([
            "key" => $key,
            "tag" => $this->tag
        ]);
    }

}