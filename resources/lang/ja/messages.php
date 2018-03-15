<?php
return [
  'action' => [
    'login'       => 'ログイン',
    'logout'      => 'ログアウト',
    'register'    => '登録',
    'cancel'      => 'キャンセル',
    'upload'      => 'アップロード',
    'download'    => 'ダウンロード',
    'delete'      => '削除',
    'update'      => '更新',
    'edit'        => '編集',
    'delete_user' => 'アカウントを削除する',
    'remember_me' => 'ログイン状態を記憶する',
    'send_reset'  => 'パスワード再設定用メールを送信する',
    'reset'       => '再設定',
    'search'      => '検索',
  ],

  'user' => [
    'admin'                 => '管理者',
    'guest'                 => '投稿者',
    'list'                  => 'ユーザー一覧',
    'name'                  => 'ユーザー名',
    'email'                 => 'メールアドレス',
    'password'              => 'パスワード',
    'password_confirmation' => 'パスワード（確認）',
    'created_at'            => '登録日',
    'permission'            => '権限',
  ],

  'addon' => [
    'list'        => '投稿一覧',
    'filename'    => 'ファイル名',
    'user'        => '投稿者',
    'paksize'     => 'Pakサイズ',
    'count'       => 'DL回数',
    'created_at'  => '投稿日',
    'upload_file' => 'アップロードファイル',
    'title'       => 'タイトル',
    'description' => '説明',
    'paks'        => 'Pakサイズ',
  ],

  'label' => [
    'no_item'              => '投稿がありません',
    'required'             => '必須',
    'optional'             => '任意',
    'profile'              => 'ユーザー情報',
    'action'               => '操作',
    'has_incomplete'       => '未完了の投稿があります',
    'confirm'              => 'よろしいですか',
    'confirm_delete_user'  => 'アカウントを削除してもよろしいですか',
    'confirm_delete_item'  => '削除してもよろしいですか',
    'confirm_cancel_input' => '投稿をキャンセルしてもよろしいですか',
    'keyword'              => 'キーワード',
  ],

  'page' => [
    'addon' => [
      'index'  => 'トップ',
      'input'  => '登録情報入力',
      'manage' => '投稿一覧',
      'search' => ':word の検索結果',
    ],
    'admin' => [
      'addon' => '投稿一覧',
      'user'  => 'ユーザー一覧',
    ],
    'auth' => [
      'register' => 'ユーザー登録',
      'login'    => 'ログイン',
      'email'    => 'パスワード再発行',
      'reset'    => 'パスワード再設定',
    ],
    'user' => [
      'index' => 'ユーザー情報',
      'edit'  => 'ユーザー編集',
    ],
  ],

  'error' => [
    'file_store_failed'   => 'ファイルを保存できませんでした',
    'dat_not_found'       => 'datファイルがありません',
    'file_analyze_failed' => 'ファイルを解析できませんでした',
    'file_not_found'      => 'ファイルがありません',
    'post_not_found'      => '指定された投稿がありません',
    'file_delete_failed'  => '削除に失敗しました',
    'page_not_found'      => 'ページが見つかりません',
  ],
  'success' => [
    'publish'        => '投稿しました',
    'cancel'         => '投稿をキャンセルしました',
    'delete'         => '削除しました',
    'delete_account' => 'アカウントを削除しました',
    'update'         => '更新しました',
  ],
];
