<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/25
 * Time: 14:32
 */

namespace Chatbox\Token\Storage\DB;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Builder;

trait TaggableTokenDBTrait
{
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

    public function downTable(Builder $builder)
    {
        $builder->dropIfExists($this->table);
    }
}