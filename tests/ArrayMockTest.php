<?php

use Chatbox\Token\Storage\Mock\ArrayStorage;

class ArrayMockTest extends AbstractTokenTest
{
    protected function tokenService():\Chatbox\Token\TokenServiceInterface
    {
        $arrayMock = new ArrayStorage();
        return new \Chatbox\Token\TokenService($arrayMock);
    }
}
