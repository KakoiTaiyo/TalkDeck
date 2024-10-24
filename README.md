# Talk Deck

このアプリケーションは，初対面の相手とうまく会話をするために利用するものです．相手のアカウントにある情報と自分のアカウントにある情報をもとにして Gemini が質問を考えてくれます．

## メンバー

- 池田 陽人
- 栫 大耀
- 當山 史華
- 平野 健汰

## 機能

- ユーザー登録，ログイン・ログアウト機能
- アカウント検索機能
- トークデッキ表示機能
- フォロー機能

## 使用技術

- Laravel Sail
- MySQL
- Gemini API

## 使い方

1. ログインする(ユーザー登録する)
2. ユーザー検索を行う(相手のアカウント名を聞く)
3. 選択するボタンを押す
4. トークデッキができるので相手との会話をする

## シーケンス図

```mermaid
sequenceDiagram
    actor ユーザー
    participant ブラウザ
    participant サーバー
    participant データベース
    participant Gemini API
    ユーザー->>+ブラウザ: ユーザーid, アカウント名, 回答内容, パスワード, 確認パスワード入力
    ブラウザ->>+サーバー: ユーザーid, アカウント名, 回答内容, パスワード, 確認パスワード入力
    サーバー->>+データベース:パスワードをハッシュ化し送信内容をuserテーブルに挿入
    データベース->>-サーバー:挿入完了を送信

    alt 照合に成功
        サーバー->>ブラウザ: ユーザーにログイン許可，Dashboard画面を送信
        ブラウザ->>ユーザー: ログイン，Dashboard画面表示
    else 照合に失敗
        サーバー->>-ブラウザ: エラー表示と入力パスワードを空欄にして，登録画面を送信
        ブラウザ->>-ユーザー: 再度登録画面を表示
    end

    ユーザー->>+ブラウザ: email, パスワードを入力
    ブラウザ->>+サーバー: 入力内容を送信
    サーバー->>+データベース: 入力内容を送信
    データベース->>-サーバー: 結果送信

    alt 照合に成功
    サーバー->>ブラウザ: ログイン成功
    ブラウザ->>ユーザー: ダッシュボード画面を表示
    else 照合に失敗
    サーバー->>-ブラウザ: エラーメッセージを追加したログイン画面を送信
    ブラウザ->>-ユーザー: メッセージが追加されたログイン画面を表示
    end

    ユーザー->>+ブラウザ: マイページでフォロー数，フォロワー数をクリック
    ブラウザ->>+サーバー: ユーザーidを送信
    サーバー->>+データベース: userテーブルから対応するアカウント名を申請
    データベース->>サーバー: アカウント名を送信
    サーバー->>ブラウザ: フォロー，フォロワー確認画面を送信
    ブラウザ->>ユーザー: フォロー，フォロワー確認画面を表示
    ユーザー->>ブラウザ: ユーザー検索画面，フォロー，フォロワー確認画面からアカウント名をクリック
    ブラウザ->>サーバー: 選択したアカウント名に対応するidを送信
    サーバー->>ブラウザ: idに対応するマイページを送信
    ブラウザ->>ユーザー: マイページを表示

    alt フォローする
    ユーザー->>ブラウザ: フォローボタンをクリック
    ブラウザ->>サーバー: 選択したアカウントidを送信
    サーバー->>データベース: followテーブルに登録
    データベース->>サーバー: 登録完了したことを送信
    サーバー->>ブラウザ: フォローボタンをフォローをやめるボタンに変更した画面を送信
    ブラウザ->>ユーザー: 変更した画面を再度表示
    else フォローをやめる
    ユーザー->>ブラウザ: フォローをやめるボタンをクリック
    ブラウザ->>サーバー: 選択したアカウントidを送信
    サーバー->>データベース: followテーブルから削除
    データベース->>-サーバー: 削除完了したことを送信
    サーバー->>-ブラウザ: フォローをやめるボタンをフォローボタンに変更した画面を送信
    ブラウザ->>-ユーザー: 変更した画面を再度表示
    end

    ユーザー->>+ブラウザ: アカウント名を検索フォームに入力
    ブラウザ->>+サーバー: 入力内容を送信
    サーバー->>+データベース: データ送信を申請
    データベース->>-サーバー: データを送信
    サーバー->>-ブラウザ: ユーザーを絞り込み
    ブラウザ->>-ユーザー: 絞り込んだユーザーを表示

    ユーザー->>+ブラウザ: アカウント名を選択
    ブラウザ->>+サーバー: 選択されたアカウントのuser_idを送信
    サーバー->>+データベース: データ送信を申請
    データベース->>-サーバー: 回答内容を送信
    サーバー->>+Gemini API: リクエスト送信
    Gemini API->>-サーバー: レスポンス送信
    サーバー->>-ブラウザ: 回答内容を送信
    ブラウザ->>-ユーザー: 回答内容を表示

    ユーザー->>+ブラウザ: ログアウトボタンを押下
    ブラウザ->>+サーバー: セッションをリセット
    サーバー->>-ブラウザ: 初期画面に遷移
    ブラウザ->>-ユーザー: ログアウト


```
