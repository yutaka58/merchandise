# mogitate(商品一覧)

## 環境構築

**Docker ビルド**

1. DockerDesktop アプリを立ち上げる
2. `docker-compose up -d --build`

**Laravel 環境構築**

1. `docker-compose exec php bash`
2. laravel のプロジェクトの作成
3. `composer create-project "laravel/laravel=8.*" . --prefer-dist`
4. 作成された「.env」に以下の環境変数を追加

```text
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```

5. アプリケーションキーの作成

```bash
php artisan key:generate
```

6. マイグレーションの実行

```bash
php artisan migrate
```

7. シーディングの実行

```bash
php artisan db:seed
```

## 使用技術(実行環境)

- PHP8.1.33
- Laravel8.83.29
- MySQL8.0.26

## ER 図

![alt](erd.png)

## URL

- 開発環境：http://localhost/
- phpMyAdmin:：http://localhost:8080/
# merchandise
