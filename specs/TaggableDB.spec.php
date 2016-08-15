<?php


describe("TaggableDB",function(){
    $storage = new \App\Model\TaggableDB();
    $token = new \Chatbox\Token\TokenService($storage);

    $spec = new \Chatbox\Token\Specs\TokenServiceSpecs($token);

    $spec->describe([
        "hoge" => "piyo"
    ]);
});

