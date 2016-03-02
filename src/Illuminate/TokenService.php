<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/03/03
 * Time: 2:28
 */

namespace Chatbox\Token\Illuminate;


use Carbon\Carbon;
use Chatbox\Token\Token;
use Chatbox\Token\TokenExpiredException;
use Chatbox\Token\TokenNotFoundException;
use Chatbox\Token\TokenServiceInterface;
use Chatbox\Token\TokenServiceTrait;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TokenService implements TokenServiceInterface
{
    protected $table;

    protected $expiredAt;

    public function save($value, $key = null):Token
    {
        $key = $key?:$this->getKey();
        $now = Carbon::now();
        $this->getTable()->insert([
            "key" => $key,
            "value" => $value,
            "created_at" => $now
        ]);
        return $this->getToken($key,$value,$now);
    }

    public function load($key):Token
    {
        $tokenRow = $this->getTable()->where("key",$key)->first();
        if($tokenRow){
            $token = $this->getToken($tokenRow->key,$tokenRow->value,$tokenRow->created_at);
            if($this->getExpiredAt() > $token->createdAt ){
                return $token;
            }else{
                throw new TokenExpiredException;
            }
        }else{
            throw new TokenNotFoundException;
        }
    }

    public function keep($key)
    {
        $token = $this->load($key);
        return $this->save($token->value,$this->getKey());
    }

    public function delete($key)
    {
        $this->getTable()->where("key",$key)->delete();
    }

    public function clear()
    {
        $this->getTable()->where("created_at","<=", $this->getExpiredAt())->delete();
    }

    public function count()
    {
        return $this->getTable()->count();
    }

    protected function getTable():Builder{
        return DB::table($this->table);
    }

    protected function getKey(){
        return Str::random(32);
    }

    protected function getToken($key,$value,Carbon $createdAt){
        return new Token($key,$value,$createdAt);
    }

    protected function getExpiredAt(){
        return Carbon::now()->subSecond($this->expiredAt);
    }

}