<?php


describe("TaggableEloquent",function(){
    $storage = new \App\Model\TaggableEloquent();
    $token = new \Chatbox\Token\TokenService($storage);

    $spec = new \Chatbox\Token\Specs\TokenServiceSpecs($token);

    $spec->describe([
        "hoge" => "piyo"
    ]);
});

