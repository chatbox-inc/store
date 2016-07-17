<?php

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/07/18
 * Time: 0:07
 */
abstract class AbstractTokenTest extends TestCase
{
    use \Chatbox\Token\Storage\RandomKeyTrait;

    /**
     * @var \Chatbox\Token\TokenServiceInterface
     */
    protected $token;

    public function setUp()
    {
        parent::setUp();
        if(!$this->token){
            $this->token = $this->tokenService();
        }
        \Carbon\Carbon::setTestNow();
    }


    abstract protected function tokenService():\Chatbox\Token\TokenServiceInterface;

    /**
     * @expectedException \Chatbox\Token\TokenNotFoundException
     */
    public function testNotfound(){
        $key = $this->ramdomKey();
        $this->token->load($key);
    }

    public function testSave(){
        $sample = [
            "hoge" => "piyo"
        ];
        $token = $this->token->save($sample);

        $this->assertInstanceOf(Chatbox\Token\Token::class,$token);
        $this->assertFalse(empty($token->key));
        $this->assertEquals($token->createdAt,\Carbon\Carbon::now());

        $toLoadKey = $token->key;
        $token = $this->token->load($toLoadKey);

        $this->assertInstanceOf(Chatbox\Token\Token::class,$token);
        $this->assertEquals($token->key,$toLoadKey);
        $this->assertEquals($token->value,$sample);
        $this->assertEquals($token->createdAt,\Carbon\Carbon::now());
    }
}