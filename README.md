# BookMarks For Laravel
https://book-marks.ml

## 概要
[BookMarks](https://github.com/stogashi146/BookMarks)を
LaravelとDockerで開発しました。
また、laravel版では小説の表示買いをテーマにしました。

## 追加機能
以下の機能を追加しました。

#### ・お問い合わせ機能
メールにて問い合わせができます
#### ・ソート機能
ユーザーページで、本一覧、ユーザー一覧のソートができます。
#### ・N+1問題の解決
内部結合で予めリレーション先のデータを取得することで、
N+1問題を解決しました。

※該当ページ(本詳細、ユーザー詳細、ランキング)

## デプロイ環境
AWS ECS、ECRでデプロイを実施

## 開発環境
- PHP 8.0.13
- Laravel Framework 6.20.41
- Docker version 20.10.7
