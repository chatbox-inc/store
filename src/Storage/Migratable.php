<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/14
 * Time: 18:15
 */

namespace Chatbox\Token\Storage;


use Illuminate\Database\Schema\Builder;

interface Migratable
{
    public function upTable(Builder $builder);

    public function downTable(Builder $builder);

}