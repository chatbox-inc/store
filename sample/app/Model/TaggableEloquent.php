<?php
namespace App\Model;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/08/15
 * Time: 18:13
 */
class TaggableEloquent extends \Chatbox\Token\Storage\Eloquent\TaggableEloquent
{
    protected $table = "sample_taggableeloquent";
}