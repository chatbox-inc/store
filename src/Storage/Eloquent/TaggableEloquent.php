<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/14
 * Time: 17:56
 */

namespace Chatbox\Token\Storage;

use Chatbox\Token\Storage\Eloquent\Eloquent;
use Chatbox\Token\Token;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

class TaggableEloquent extends Eloquent
{
    protected $tag = "tokentag";

    protected $fillable = ["key","value","tag"];

    public function saveToken($value, $key = null):Token
    {
        return $this->_saveToken([
            "key" => $key ?: $this->ramdomKey(),
            "value" => $value,
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

    public function upTable(Builder $builder)
    {
        $builder->create($this->table,function(Blueprint $blueprint){
            $blueprint->increments("id");
            $blueprint->string("key")->unique();
            $blueprint->string("tag");
            $blueprint->text("value");
            $blueprint->timestamp("created_at");
        });
    }
}