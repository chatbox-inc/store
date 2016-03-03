<?php
namespace Chatbox\Token;
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/03/03
 * Time: 2:12
 */
interface TokenServiceInterface
{
    public function save($value,$key=null):Token;

    public function load($key):Token;

    public function call($key,callable $callable);

    public function keep($key);

    public function delete($key);

    public function clear();

    public function count();
}

class TokenException extends \Exception{}

class TokenNotFoundException extends TokenException{}

class TokenExpiredException extends TokenException{

    protected $token;

    /**
     * @return mixed
     */
    public function getToken():Token
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken(Token $token)
    {
        $this->token = $token;
    }
}

class TokenCantSaveException extends TokenException{}