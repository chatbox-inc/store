<?php


describe("CacheToken",function(){
    $storage = new \App\Model\TaggableEloquent();
    $token = new \Chatbox\Token\CacheTokenService(app("cache")->store());

    $spec = new \Chatbox\Token\Specs\TokenServiceSpecs($token);

    $spec->describe([
        "hoge" => "piyo"
    ]);
});

