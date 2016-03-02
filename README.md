# トークン管理アプリケーション

トークンを利用したKeyValueStoreの生成


````
$tokenService = app(TokenService::class);

$token = $tokenService->save($someValue);
echo $token->key; // farairgarha

$token = $tokenService->load($tokenKey);
if($token->available()){
    echo $token->value; // token value
    $tokenService->delete();
}


````