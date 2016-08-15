<?php
namespace Chatbox\Token\Specs;
use Carbon\Carbon;
use Chatbox\Token\Token;
use Chatbox\Token\TokenNotFoundException;
use Chatbox\Token\TokenServiceInterface;

/**
 * Created by PhpStorm.
 * User: mkkn
 * Date: 2016/08/15
 * Time: 0:36
 */
class TokenServiceSpecs
{
    public function __construct(TokenServiceInterface $token,array $data = null)
    {
        $this->token = $token;
        $this->data = $data;
    }

    public function describe(array $data = null){

        if($data){
            $this->data = $data;
        }

        $self = $this;

        describe("TOKEN SERVEICE",function()use($self){
            it("CAN STORE & LOAD EACH DATA",[$self,"testStoreAndLoadData"]);
        });


    }


    public function testStoreAndLoadData(){

        $tokens = [];
        //トークンの保存
        foreach ($this->data as $value) {
            $token = $this->token->save($value);
            assert($token instanceof Token,"save should return Token object");
            assert(is_string($token->key),"\$token->key should be string");
            assert($token->value === $value,"\$token->value should equal original data");
            assert($token->createdAt instanceof Carbon,"\$token->createdAt should be Carbon instance");
            $tokens[] = $token;
        }

        // トークンを使った読み出し
        foreach ($tokens as $token) {
            /** @var Token $token */
            $_token = $this->token->load($token->key);
            assert($_token instanceof Token,"save should return Token object");
            assert(is_string($_token->key),"\$token->key should be string");
            assert($_token->value === $token->value,"\$token->value should equal original data");
            assert($_token->createdAt instanceof Carbon,"\$token->createdAt should be Carbon instance");
        }

        // 削除したトークンは読み出せない
        foreach ($tokens as $token) {
            /** @var Token $token */
            $_token = $this->token->delete($token->key);
            $e = null;
            try{
                $_token = $this->token->load($token->key);
            }catch(TokenNotFoundException $_e){
                $e = $_e;
            }
            assert($e instanceof TokenNotFoundException,"should throw exception");
        }






    }




}