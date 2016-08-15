<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/08/15
 * Time: 1:00
 */

namespace Chatbox\Token;


use Carbon\Carbon;
use Chatbox\Token\Storage\RandomKeyTrait;
use Illuminate\Cache\CacheManager;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Support\Facades\Cache;

class CacheTokenService implements TokenServiceInterface
{
    use RandomKeyTrait;

    protected $cache;
    protected $token;

    public function __construct(Repository $cache=null,$prefix="token")
    {
        if($cache === null){
            $cache = app("cache")->store();
        }
        $this->cache = $cache;
    }

    public function save($value, $key = null):Token
    {
        if(!$key){
            $key = $this->ramdomKey();
        }
        $this->cache->put($key,$value);
        return $this->getEntity($key,$value);
    }

    public function load($key):Token
    {
        if($value = $this->cache->get($key,null)){
            return $this->getEntity($key,$value);
        }else{
            throw new TokenNotFoundException;
        }
    }

    public function delete($key)
    {
        $this->cache->forget($key);
    }

    protected function getEntity($key,$value){
        return new Token($key,$value,Carbon::now());
    }


}