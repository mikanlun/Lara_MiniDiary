# Lara_MiniDiary

ミニ日記（Laravelフレームワーク）

## Description

どなたでも、自由にミニ日記を作成することができます。  
写真でその日の出来事が明確に思い出されます。

***SAMPLE:***
![sample](https://user-images.githubusercontent.com/36429862/101758305-8830fe00-3b1b-11eb-830c-92655a4a2425.png)
## Features

・複数ユーザーのダイアリーの表示（認証済みの時は、認証ユーザーのみ表示）  
・ダイアリーの個別表示（画像をクリックで表示)  
・ダイアリーの日付移動（矢印キーで移動。但し、登録されていない日付はスキップ）  
・ダイアリーの検索（ユーザー及び、日付の選択）  
・ダイアリーの選択（カレンダーの日付の背景が緑色の時）  

## Requirement

・CentOS 7.4  
・PHP 7.1  
・mysql 5.7  
・twig 2.4  
・slick 1.8  
・bootstrap 4.0  
・Laravel Framework 6.20.4  

## Usage

1.ダイアリーの処理  
　・ダイアリーの登録（メニューバーのユーザー名のプルダウンメニューより）  
　・公開日を指定できる （認証済みの時）  
　・ダイアリーの編集（画像をクリックで表示 -> 編集）（認証済みの時）  
　・ダイアリーの削除（画像をクリックで表示 -> 編集 -> 削除）（認証済みの時）  
2.アカウント  
　・ログイン（メニューバーより）  
　・ログアウト（メニューバーのユーザー名のプルダウンメニューより）（認証済みの時）  
　・ユーザーの新規登録（メニューバーより）  
　・ユーザーの編集、退会(削除)  
　（メニューバーのユーザー名のプルダウンメニューのアカウントより）（認証済みの時）  
3.その他  
　・about（メニューバーより）  
　・お問い合わせ（メニューバーより）  

## Settings

　1.env ファイルの設定

    ・ 適宜、ご変更をお願いします。

　2.PERMISSIONS

    ・ strageとbootstrap/cacheディレクトリにread, write 権限を設定してください。

　3.テーブルの作成

    ・ マイグレートをおこなってください。

　４.シンボリックリンク

    ・ public/storageからstorage/app/publicへシンボリックリンクを張ってください。

     php artisan storage:link
  　

## Author

@mikanlun

## License

[MIT](https://github.com/mikanlun/MyGallery/blob/master/LICENSE)
