<?php
/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/14
 * Time: 18:16
 */

namespace Chatbox\Token\Storage;

trait RandomKeyTrait
{
    protected function ramdomKey(){
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return mb_substr(str_shuffle(str_repeat($pool, 16)), 0, 16);
    }

}