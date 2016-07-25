<?php

use Chatbox\Token\Storage\Mock\ArrayStorage;
use Chatbox\Token\Storage\Eloquent\Eloquent;
use Chatbox\Token\Storage\Eloquent\TaggableEloquent;

class TaggableDBTest extends AbstractTokenTest
{
    static protected $storage;

    protected function tokenService():\Chatbox\Token\TokenServiceInterface
    {
        file_put_contents(app()->databasePath()."/database.sqlite","");
        static::$storage = new class() extends \Chatbox\Token\Storage\DB\TaggableDB
        {
            protected $table = "test_table";
        };
        /** @var \Illuminate\Database\DatabaseManager $db */
        $db = app("db");
        static::$storage->upTable($db->connection()->getSchemaBuilder());
        return new \Chatbox\Token\TokenService(static::$storage);
    }
}
