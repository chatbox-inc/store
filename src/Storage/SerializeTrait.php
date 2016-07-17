<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/18
 * Time: 0:49
 */

namespace Chatbox\Token\Storage;


trait SerializeTrait
{
    protected function serialize($value){
        return base64_encode(serialize($value));
    }

    protected function unserialize($value){
        return unserialize(base64_decode($value));
    }

}