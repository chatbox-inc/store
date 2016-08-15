<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/08/15
 * Time: 1:00
 */

namespace Chatbox\Token;


use Chatbox\Token\Storage\RandomKeyTrait;
use Illuminate\Cache\CacheManager;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Support\Facades\Cache;

class CacheTokenService implements TokenServiceInterface
{
    use RandomKeyTrait;

    protected $cache;

    public function __construct(CacheManager $cacheManager)
    {
        $this->cache = $cacheManager;
    }

    /**
     * @return Repository
     */
    protected function getRepository(){
        return $this->cache->store(null);
    }

    public function save($value, $key = null):Token
    {
        $this->getRepository()->put($key,$value);
    }

    public function load($key):Token
    {
        $this->getRepository()->get($key,$value);
    }

    public function delete($key)
    {
        $this->getRepository()->put($key,$value);
    }


}