<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/14
 * Time: 17:56
 */

namespace Chatbox\Token\Storage\Eloquent;

use Chatbox\Token\Token;
use Chatbox\Token\TokenNotFoundException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;
use Chatbox\Token\Storage\Migratable;
use Chatbox\Token\Storage\RamdomKeyTrait;
use Chatbox\Token\Storage\TokenStorageInterface;

class Eloquent extends Model implements TokenStorageInterface,Migratable
{
    use RamdomKeyTrait;

    protected $table;

    protected $fillable = ["key","value"];

    public $timestamps = false;

    protected $dates = ["created_at"];

    protected function getEntity(Eloquent $eloquent){
        return new Token($eloquent->key, $eloquent->value, $eloquent->created_at);
    }

    public function saveToken($value, $key = null):Token
    {
        return $this->_saveToken([
            "key" => $key ?: $this->ramdomKey(),
            "value" => $value
        ]);
    }

    protected function _saveToken($attr){
        $model = $this->newInstance($attr);
        $model->save();
        return $this->getEntity($model);
    }

    public function loadToken($key):Token
    {
        return $this->_loadToken([
            "key" => $key
        ]);
    }

    protected function _loadToken($attr){
        $models = $this->where($attr)->get();

        if(count($models) === 1){
            return $this->getEntity($models[0]);
        }else{
            throw new TokenNotFoundException();
        }
    }

    public function deleteToken($key)
    {
        return $this->_deleteToken([
            "key" => $key
        ]);
    }

    protected function _deleteToken($attr){
        $this->where($attr)->delete();
    }

    public function upTable(Builder $builder)
    {
        $builder->create($this->table,function(Blueprint $blueprint){
            $blueprint->increments("id");
            $blueprint->string("key")->unique();
            $blueprint->text("value");
            $blueprint->timestamp("created_at");
        });
    }

    public function downTable(Builder $builder)
    {
        $builder->dropIfExists($this->table);
    }


}