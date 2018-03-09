<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attributeを承認してくださいです。',
    'active_url'           => ':attributeは正しいURLではありません。',
    'after'                => ':attributeは:dateより後の日付にしてくださいです。',
    'after_or_equal'       => ':attributeは:date以降の日付にしてくださいです。',
    'alpha'                => ':attributeは英字のみにしてくださいです。',
    'alpha_dash'           => ':attributeは英数字とハイフンのみにしてくださいです。',
    'alpha_num'            => ':attributeは英数字のみにしてくださいです。',
    'array'                => ':attributeは配列にしてくださいです。',
    'before'               => ':attributeは:dateより前の日付にしてくださいです。',
    'before_or_equal'      => ':attributeは:date以前の日付にしてくださいです。',
    'between'              => [
        'numeric' => ':attributeは:min〜:maxまでにしてくださいです。',
        'file'    => ':attributeは:min〜:max KBまでのファイルにしてくださいです。',
        'string'  => ':attributeは:min〜:max文字にしてくださいです。',
        'array'   => ':attributeは:min〜:max個までにしてくださいです。',
    ],
    'boolean'              => ':attributeはtrueかfalseにしてくださいです。',
    'confirmed'            => ':attributeは確認用項目と一致していません。',
    'date'                 => ':attributeは正しい日付ではありません。',
    'date_format'          => ':attributeは":format"書式と一致していません。',
    'different'            => ':attributeは:otherと違うものにしてくださいです。',
    'digits'               => ':attributeは:digits桁にしてくださいです。',
    'digits_between'       => ':attributeは:min〜:max桁にしてくださいです。',
    'dimensions'           => ':attributeは無効な画像サイズなのです。',
    'distinct'             => ':attributeは値が重複しています。',
    'email'                => ':attributeを正しいメールアドレスにしてくださいです。',
    'exists'               => '選択された:attributeは正しくありません。',
    'file'                 => ':attributeはファイルにしてくださいです。',
    'filled'               => ':attributeは必須なのです。',
    'image'                => ':attributeは画像にしてくださいです。',
    'in'                   => '選択された:attributeは正しくありません。',
    'in_array'             => ':attributeは:otherの中から選んでください。',
    'integer'              => ':attributeは整数にしてくださいです。',
    'ip'                   => ':attributeを正しいIPアドレスにしてくださいです。',
    'ipv4'                 => ':attributeを正しいIPv4アドレスにしてくださいです。',
    'ipv6'                 => ':attributeを正しいIPv6アドレスにしてくださいです。',
    'json'                 => ':attributeを正しいJSONにしてくださいです。',
    'max'                  => [
        'numeric' => ':attributeは:max以下にしてくださいです。',
        'file'    => ':attributeは:max KB以下のファイルにしてくださいです。.',
        'string'  => ':attributeは:max文字以下にしてくださいです。',
        'array'   => ':attributeは:max個以下にしてくださいです。',
    ],
    'mimes'                => ':attributeは:valuesタイプのファイルにしてくださいです。',
    'mimetypes'            => ':attributeは:valuesタイプのファイルにしてくださいです。',
    'min'                  => [
        'numeric' => ':attributeは:min以上にしてくださいです。',
        'file'    => ':attributeは:min KB以上のファイルにしてくださいです。.',
        'string'  => ':attributeは:min文字以上にしてくださいです。',
        'array'   => ':attributeは:min個以上にしてくださいです。',
    ],
    'not_in'               => '選択された:attributeは正しくありません。',
    'numeric'              => ':attributeは数字にしてくださいです。',
    'present'              => ':attributeは存在する必要があります。',
    'regex'                => ':attributeの書式が正しくありません。',
    'required'             => ':attributeは必須なのです。',
    'required_if'          => ':otherが:valueの場合、:attributeは必須なのです。',
    'required_unless'      => ':otherが:valueにない場合、:attributeは必須なのです。',
    'required_with'        => ':valuesが存在する場合、:attributeは必須なのです。',
    'required_with_all'    => ':valuesが存在する場合、:attributeは必須なのです。',
    'required_without'     => ':valuesが存在しない場合、:attributeは必須なのです。',
    'required_without_all' => ':valuesが存在しない場合、:attributeは必須なのです。',
    'same'                 => ':attributeと:otherが一致していません。',
    'size'                 => [
        'numeric' => ':attributeは:sizeにしてくださいです。',
        'file'    => ':attributeは:size KBにしてくださいです。.',
        'string'  => ':attribute:size文字にしてくださいです。',
        'array'   => ':attributeは:size個にしてくださいです。',
    ],
    'string'               => ':attributeは文字列にしてくださいです。',
    'timezone'             => ':attributeは正しいタイムゾーンをしていしてくださいです。',
    'unique'               => ':attributeは既に存在します。',
    'uploaded'             => ':attributeはアップロードできませんでした。',
    'url'                  => ':attributeを正しい書式にしてくださいです。',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
      'upload_file' => 'アップロードファイル',
      'title'       => 'タイトル',
      'description' => '説明',
      'paks'        => 'Pakサイズ',
      'paks.*'      => 'Pakサイズ',
      'name'        => '氏名',
      'email'       => 'メールアドレス',
    ],

];
