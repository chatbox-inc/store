<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/14
 * Time: 16:57
 */

namespace Chatbox\Token;

use Chatbox\Token\Storage\TokenStorageInterface;

class TokenService implements TokenServiceInterface
{
    protected $storage;

    public function __construct(TokenStorageInterface $storage)
    {
        $this->storage = $storage;
    }


    public function save($value, $key = null):Token
    {
        return $this->storage->saveToken($value,$key);
    }

    public function load($key):Token
    {
        return $this->storage->loadToken($key);
    }

    public function delete($key)
    {
        return $this->storage->deleteToken($key);
    }
}