<?php


describe("CacheToken",function(){

    /** @var \Illuminate\Contracts\Cache\Repository $store */
    $store = app("cache")->store();

    it("cache configured",function()use($store){
        $store->forever("hoge","piyo");
        $value = $store->get("hoge");
        assert($value === "piyo");
    });

    $token = new \Chatbox\Token\CacheTokenService($store);

    $spec = new \Chatbox\Token\Specs\TokenServiceSpecs($token);

    $spec->describe([
        "hoge" => "piyo"
    ]);
});

