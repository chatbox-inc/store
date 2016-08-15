<?php

describe("ArrayMock ",function(){
    $storage = new \Chatbox\Token\Storage\Mock\ArrayStorage();
    $token = new \Chatbox\Token\TokenService($storage);

    $spec = new \Chatbox\Token\Specs\TokenServiceSpecs($token);

    $spec->describe([
        "hoge" => "piyo"
    ]);
});
