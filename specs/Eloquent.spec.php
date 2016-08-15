<?php

describe("Eloquent",function(){
    $storage = new \App\Model\Eloquent();
    $token = new \Chatbox\Token\TokenService($storage);

    $spec = new \Chatbox\Token\Specs\TokenServiceSpecs($token);

    $spec->describe([
        "hoge" => "piyo"
    ]);

});

