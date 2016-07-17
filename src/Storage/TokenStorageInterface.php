<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/14
 * Time: 16:58
 */

namespace Chatbox\Token\Storage;

use Chatbox\Token\Token;

interface TokenStorageInterface
{
    /**
     * @param $value
     * @param null $key
     * @return
     */
    public function saveToken($value,$key=null):Token;

    /**
     * @param $key
     * @return Token
     */
    public function loadToken($key):Token;

    public function deleteToken($key);

}