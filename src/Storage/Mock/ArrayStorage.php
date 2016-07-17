<?php
namespace Chatbox\Token\Storage\Mock;
use Carbon\Carbon;
use Chatbox\Token\Storage\RandomKeyTrait;
use Chatbox\Token\Token;
use Chatbox\Token\Storage\TokenStorageInterface;
use Chatbox\Token\TokenNotFoundException;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/17
 * Time: 23:59
 */
class ArrayStorage implements TokenStorageInterface
{
    use RandomKeyTrait;

    protected $mock = [];

    public function saveToken($value, $key = null):Token
    {
        $key = $key ?: $this->ramdomKey();
        $this->mock[$key] = $value;
        return new Token($key,$value,Carbon::now());
    }

    public function loadToken($key):Token
    {
        $value = array_get($this->mock,$key);
        if($value){
            return new Token($key,$value,Carbon::now());
        }else{
            throw new TokenNotFoundException;
        }
    }

    public function deleteToken($key)
    {
        $value = array_get($this->mock,$key);
        if($value){
            unset($this->mock[$key]);
        }else{
            throw new TokenNotFoundException;
        }
    }


}