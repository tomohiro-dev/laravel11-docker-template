DockerをベースとしたLaravel11, MySQL, nginxの開発環境。

# 環境構築手順
## Codeからgit cloneする
### cloneしたDirectoryに移動
移動したタイミングでDockerを一旦立ち上げる
```
docker compose up -d --build
```
※compose.yamlファイルを改修した場合は都度立ち上げ直すこと）

## Laravelをインストール
### appコンテナに入る
```
docker compose exec app bash
```

todo: このあたり諸々設定が必要なので後ほど書き直す

### Laravelに必要なパッケージをインストール
```
composer self-update→毎回updateするのがめんどいので書き換える
composer install
```

バージョンを確認
```
php artisan -V
```

ローカルホストへ接続
500 | servert errorが出ることを確認する（正しい） `composer install`時は `.env`環境変数ファイルは作成されないので、 
`.env.example`を元にコピーして作成する。

### `.env`ファイルの設定
```
cp .env.example .env
```
DBの設定を行う

### アプリケーションキーをつくる
appコンテナへ移動する
```
docker compose exec app bash
```

アプリケーションキーを作成する
```
php artisan key:generate
```
暗号化の際に使われる。SessionやAuth機能など。App Keyが確実に指定されていれば暗号化された値は安全。

### シンボリックリンクをつくる
appコンテナ内でやる
```
php artisan storage:link
```
public/storage から storage/app/public へのシンボリックリンクをつくる システムで生成したファイル等をブラウザからアクセスできるよう公開するため。strorage dirにアクセスするためのもの。

Laravelで作ったプリケーションが公開されるとき、公開されるのは一番上の階層にある public ディレクトリのみ。
public ディレクトリにファイルや処理のすべてが集約される。保存した画像も public ディレクトリ内に存在しないとアクセスすることがで着なくなってしまうので、その予防策。


### 書き込み権限を追加する
```
chmod -R 777 storage bootstrap/cache
```
-R : recursive
`storage,bootstrap/cache`はフレームワークからファイル書き込みが発生するので、書き込み権限を与える。

## Dockerで立ち上げる
一旦最初に作成したImageとVolumesやnetworkは消す
```
docker compose down --rmi all --volumes --remove-orphans
```

### Docker composeでBuildする
```
docker compose up -d --build
```

立ち上がっているか確認
```
docker ps -a
```

### バージョンの確認
・Laravel
Docker立ち上げ後確認
```
docker compose app bash
```

```
php artisan -V
```

・MySQL

```
docker compose exec db bash
```

```
mysql --version
```

・nginx
local環境で確認
```
docker compose exec web nginx -v
```

・npm
```
npm -V
```

・Node.js
```
node -V
```

### Web Browser上で画面を確認する
・Laravel
```
http://127.0.0.1:80/
```
80番は省略される

・PhpMyAdmin
```
http://127.0.0.1:8080/
```

## データベースの設定
### `.env`ファイルの設定を確認する
`.env.example`ファイルを書き換えてコピーする

### Migrateする
```
php artisan migrate
```

### PhpMyAdminでMigrateしたデータベースとテーブルが作成されているかを確認
```
http://127.0.0.1:8080/
```

## ログの設定
### Laravelのログをコンテナログに表示させる
`backend/.env` を修正する
```
LOG_CHANNEL=stderr
```

### 表示されるかを確認

`backend/routes/web.php`に追記
```
Route::get('/', function () {
    logger('welcome route.');
    return view('welcome');
});
```

**logをみる方法3パターン**

```
$ docker compose logs

# -f でログウォッチ
$ docker compose logs -f

# サービス名を指定してログを表示
$ docker compose logs -f app
```

`docker compose logs -f app`のあとに、`http://127.0.0.1:8080/`に接続するlog上にこんな感じで表示される
```
app_1  | [2021-07-25 05:48:53] local.DEBUG: welcome route.  
app_1  | 172.20.0.3 -  25/Jul/2021:05:48:51 +0000 "GET /index.php" 200
```

・laravel/uiを追加する

```
composer require laravel/ui:1.3.0 --dev
```

-----------

**よく使うコマンドリスト**

### Docker Image, Volumes, networkを一括消去
```
docker compose down --rmi all --volumes --remove-orphans
```

### Nginxの設定テストと再読み込み（現在のNginxプロセスを停止せず、新しい設定を適用）
```
docker-compose exec web nginx -t
docker-compose exec web nginx -s reload
```

### nginxコンテナの再起動（コンテナ内部のすべてのプロセスがリセットされる）
```
docker-compose restart web
```

### 


### Laravelのキャッシュクリアコマンド
```
// 基本これ2つ
php artisan cache:clear
php artisan config:clear

//Routingの部分を実装しているとき
php artisan route:clear

//Viewの部分を実装しているとき
php artisan view:clear
```

----

## frontendコンテナについて
※Next.jsを使用する場合の例

### DockerfileをDocker/で管理、frontend-docker/を作成する
```
.
├── frontend-docker
│   └── Dockerfile
├── mysql
├── nginx
└── php
```

Dockerfileのサンプル
```
FROM node:22-alpine as node
WORKDIR /workspace/frontend

# hostのfrontend/package*.jsonをコピーする
COPY ./frontend/package*.json ./  

RUN npm install

# hostのfrontend dir全体をコピーする
COPY ../../frontend ./

# 3000は使われやすいので30000にする
EXPOSE 30000
CMD ["npm", "run", "dev"]
```

## frontendコンテナの設定を更新した場合
### frontendコンテナを停止・削除する
```
docker compose stop frontend
docker compose rm -f frontend
```

### 再ビルドする
```
docker compose build frontend
```

### 再ビルド後に、変更が反映された状態でコンテナを再立ち上げ
バックグラウンドで実行する
```
docker compose up -d frontend
```

---

## メモ
### app server立ち上げ
```
php artisan serve --host=0.0.0.0 --port=8000
```

### ネットワークが正しく作成されているか確認する
```
docker network ls
```