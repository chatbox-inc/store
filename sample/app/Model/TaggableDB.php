<?php
namespace App\Model;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/08/15
 * Time: 18:13
 */
class TaggableDB extends \Chatbox\Token\Storage\DB\TaggableDB
{
    protected $table = "sample_taggabledb";
}