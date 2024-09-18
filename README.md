# RESE

![スクリーンショット 2024-09-17 203834](https://github.com/user-attachments/assets/4aac21f2-4ab5-4854-a1ef-38cfbd6b4ab5)
- 飲食店予約サービス。
- 飲食店のお気に入り機能や予約機能、評価機能等実装しております。

##作成した目的

- ○○社自社運営の飲食店予約サービス提供の為。

##アプリケーションURL

- 開発環境：http://localhost/
- phpMyAdmin：Http://localhost:8080/

##他のリポジトリ

- 作成中

##機能一覧

- 会員登録/ログイン機能
    >新規登録後、メールアドレス・パスワードでログインします。
    
- メール認証機能
    >新規ユーザー登録により、メール認証が送られます。
  
- 飲食店一覧/詳細情報一覧
    >飲食店の一覧、またはそれらの詳細を閲覧できます。
  
- エリア/ジャンル/店名あいまい検索機能
    >飲食店をエリア・ジャンル毎、または組み合わせて検索できます。また店名のあいまい検索ができます。
 
- 飲食店お気に入り機能
    >飲食店をお気に入りとして登録できます。
 
- 飲食店予約機能
    >飲食店を予約できます。
 
- 飲食店予約情報変更/削除機能
    >予約情報の変更、または削除ができます。
    
- 飲食店評価機能
    >来店後、飲食店を★とコメントで評価できます。
    
- QRコード作成機能
    >QRコードを作成、来店時に予約情報の照合ができます。
    
- 決済機能
    >カード決済にて予め支払いができます。
  
- 管理者お知らせメール送信機能
    >各店舗管理者より、都度メールを送ることができます。

##使用技術（実行環境）

- PHP8.3.0
- Laravel 8.83.27
- MySQL8.0.26

##テーブル設計

![スクリーンショット 2024-09-17 214459](https://github.com/user-attachments/assets/5ac1554e-9664-40fd-9078-75e92df54a91)
![スクリーンショット 2024-09-17 224508](https://github.com/user-attachments/assets/31f44d97-a4b2-4925-ab2c-3ebbcf77a456)

##ER図

![スクリーンショット 2024-09-18 212027](https://github.com/user-attachments/assets/afbcef7a-45d8-4f98-b8ea-b1c99e36133e)

##環境構築

### Dockerビルド
1. `git clone `
2. DockerDesktopアプリを立ち上げる
3. `docker-compose up -d --build`

### Laravel環境構築
1. `docker-compse exec php bash`
2. `composer install`
3. .envに以下の環境変数を追加
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE= laravel_db
DB_USERNAME= laravel_user
DB_PASSWORD= laravel_pass
```
5. アプリケーションキーの作成
```
php artisan key:generate
```
7. マイグレーションの実行
```
php artisan migrate
```
8. シーディングの実行
```
php artisan migrate --seed 
```

##その他

＊テストユーザーは以下のアドレス・パスワードを用意してあります。こちらにてご確認ください。
1. 利用者　　　　アドレス：yamada@mail.com　  パスワード：yamada123
2. 店舗代表者　　アドレス：sennin@mail.com　  パスワード：sennin123
3. 管理者　　　　アドレス：admin@mail.com　   パスワード：admin1234
