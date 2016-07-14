<?php
namespace Chatbox\Token;
/**
 * シンプルにトークンに対する出し入れのみを提供する。
 */
interface TokenServiceInterface
{
    /**
     * @param $value
     * @param null $key
     * @return Token
     * @throws TokenCantSaveException
     */
    public function save($value,$key=null):Token;

    /**
     * @param $key
     * @return Token
     * @throws TokenNotFoundException
     */
    public function load($key):Token;

    public function delete($key);
}

class TokenException extends \Exception{}

class TokenNotFoundException extends TokenException{}

class TokenCantSaveException extends TokenException{}