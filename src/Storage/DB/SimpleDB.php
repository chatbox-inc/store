<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/14
 * Time: 17:56
 */

namespace Chatbox\Token\Storage\DB;

use Carbon\Carbon;
use Chatbox\Token\Storage\SerializeTrait;
use Chatbox\Token\Token;
use Chatbox\Token\TokenNotFoundException;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Model;
use Chatbox\Token\Storage\Migratable;
use Chatbox\Token\Storage\RandomKeyTrait;
use Chatbox\Token\Storage\TokenStorageInterface;
use Illuminate\Database\Query\Builder;

class SimpleDB implements TokenStorageInterface,Migratable
{
    use RandomKeyTrait;
    use SerializeTrait;
    use TokenDBTrait;

    protected $fillable = ["key","value","created_at"];

    /**
     * @return \Illuminate\Database\Query\Builder
     */
    protected function table():Builder{
        /** @var DatabaseManager $db */
        $db = app("db");
        return $db->connection()->table($this->table);
    }

    protected function getEntity($model){
        $model = (array)$model;
        return new Token($model["key"], $this->unserialize($model["value"]), $model["created_at"]);
    }

    public function saveToken($value, $key = null):Token
    {
        return $this->_saveToken([
            "key" => $key ?: $this->ramdomKey(),
            "value" => $this->serialize($value)
        ]);
    }

    protected function _saveToken($attr){
        $attr["created_at"] = Carbon::now();
        $this->table()->insert($attr);
        return $this->getEntity($attr);
    }

    public function loadToken($key):Token
    {
        return $this->_loadToken([
            "key" => $key
        ]);
    }

    protected function _loadToken($attr){
        $models = $this->table()->where($attr)->get();

        if(count($models) === 1){
            $model = $models[0];
            $model->created_at = Carbon::createFromFormat("Y-m-d H:i:s",$model->created_at);
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
        $this->table()->where($attr)->delete();
    }


}