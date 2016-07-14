# トークン管理アプリケーション

[![Latest Stable Version](https://poser.pugx.org/chatbox-inc/token/version)](https://packagist.org/packages/chatbox-inc/token)

データを投げたら、トークンに変換してくれる基本的なロジックに
インターフェイスを提供する。

## Interface 

### TokenServiceInterface::save($value,$key=null)

トークンを保存する

### TokenServiceInterface::load($key)

トークンを読み込む

### TokenServiceInterface::delete($key)

トークンを削除する

読み込み可能かどうかの判定は行わない。

## Entity

- key: トークン
- value: 値
- createdAt: 作成された日時

時刻情報を持つがExpired判定は基本行わない。

