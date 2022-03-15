# Newsmemo
**ニュースを能動的に読むことに特化したアプリです。**

**URL** : 

※アプリケーション名は、アプリケーションのコンセプトの要素である「News」と「memo」を組み合わせただけです。

## アプリ概要
### アプリケーションのコンセプト
アプリケーションのコンセプトは、以下の2点です。

1.読み終えたニュースや気になるニュースをメモ(投稿)することで、ニュースを読む習慣化を図る
<br>
2.ニュースに対するマインドマップを作成することで、考える力を習得する
### アプリケーションの特徴
基本的には、某SNSのような投稿、いいね、フォロー機能があるSNSですが、その他に以下のような特徴があります。

* 基本的に他のユーザーと直接関わるような機能はあえて実装していない<br>
(いいね機能は、ニュースに対する他のユーザーの意見や、見落としたニュースを記録するために実装)<br>
(フォロー機能は、自分とは違った視点からニュースを見ているユーザーなど、気になったユーザーを見失わないために実装)

* アプリ内で、ニュースの情報を得ることができる(NewsAPI連携) 
* 投稿累計日数やメモ総数を記録することができる
* ユーザーに人気なニュースや投稿のランキング機能
* 投稿(メモ)に対してタグ機能が使用可能であり、カテゴリ別にニュースに関する意見等を共有できる
* 投稿(メモ)に対してコレクション機能が使用可能であり、各ユーザーがジャンル別にニュースを管理できる(非公開)
* 投稿(メモ)に対して非公開コメント機能(マインドマップ機能)が使用可能であり、ニュースに対するマインドマップを作成できる
* マインドマップ機能を使うことで、考える力を養うことができる
* 読んだニュースをTwitterで共有することができる

## 開発した背景
学生の頃はニュースを受動的に見ていたが、
<br>
社会人になったタイミングで能動的にニュースを読むことを習慣化したいと思ったことがきっかけです。<br>
また、周囲の友人もニュースを読むことが習慣化できていなかったので、少しでも役立てればと思いこのサービスを考えました。
<br>
<br>
アプリケーションを作成する前は、<br>
既存のアプリケーションを使い能動的にニュースを読むことを実践しましたが、主に以下のような問題が原因で習慣化できずにいました。

* アプリケーション上のコメント欄でユーザー同士の言い争いが目に入り不快である
* 各ユーザーが個別でニュースを管理できる機能が少ない
* 習慣化に繋がる機能が実装されていない

上記のような課題を解決したアプリケーションを作成することによって、結果的にニュースを能動的に読むことを習慣化できると考えたことが開発した背景にあります。

## 使用画面のイメージ

![スクリーンショット 2022-03-15 18 47 54（2）](https://user-images.githubusercontent.com/74360349/158353015-bc361dae-72b7-4041-add9-053afb9dbc1f.png)
![スクリーンショット 2022-03-15 18 48 06（2）](https://user-images.githubusercontent.com/74360349/158353055-682243ef-cdb0-45e9-90de-cf40e99bfa3a.png)
![スクリーンショット 2022-03-15 18 48 11（2）](https://user-images.githubusercontent.com/74360349/158353073-4df49ac6-c496-4512-9f0f-0a9bfe7a2a78.png)

