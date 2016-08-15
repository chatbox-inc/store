<?php
namespace App\Model;
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/08/15
 * Time: 18:13
 */
class SimpleDB extends \Chatbox\Token\Storage\DB\SimpleDB
{
    protected $table = "sample_simpledb";
}