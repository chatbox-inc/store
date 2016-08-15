<?php


describe("SimpleDB",function(){
    $storage = new \App\Model\SimpleDB();
    $token = new \Chatbox\Token\TokenService($storage);

    $spec = new \Chatbox\Token\Specs\TokenServiceSpecs($token);

    $spec->describe([
        "hoge" => "piyo"
    ]);
});

