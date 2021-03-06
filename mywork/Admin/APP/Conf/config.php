<?php
$version = "TP02";
return array(
    'url_model' => 3, //URL模式

    'TMPL_ACTION_ERROR' => 'Common:success',
    'TMPL_ACTION_SUCCESS' => 'Common:success',

    /* 資料庫配置 */
    'DB_TYPE' => 'mysql',
    'DB_NAME' => 'allinone',

    'DB_HOST' => 'localhost',
    'DB_USER' => 'id11160920_qweasd',
    'DB_PWD' => 'qweasd',
    'DB_USER' => 'root',
    'DB_PWD' => '',


    'DB_PORT' => '3306',
    'DB_CHARSET' => 'utf8',
    'HASH_KEY' => 'asgame',

    // 'DB_PREFIX' => '',
    // 'DB_FIELDS_CACHE' => true,
    // 'DB_FIELDTYPE_CHECK' => true,

    // 'APP_AUTOLOAD_PATH' => '@.TagLib,@.Common,@.Common.Debug,@.Common.Test,@.Common.Tool',

    // 'LOAD_EXT_FILE'=>'bingoEncode',//檔案引用 Common

    'DEFAULT_MODULE' => 'AdminIndex', //默認模塊
    'DEFAULT_THEME'  => $version,
    'TMPL_PARSE_STRING'  =>array(
        '__CSS__' => 'Public/'. $version,
        '__PUBLIC__' => 'Public'
    ),


    'session_auto_start' => true,

    // 多國語系設定
    'LANG_SWITCH_ON' => true,
    'LANG_AUTO_DETECT' => true, // 自动侦测语言 开启多语言功能后有效
    'LANG_LIST' => 'zh-cn,en-us', // 允许切换的语言列表 用逗号分隔
    'VAR_LANGUAGE' => 'l' // 默认语言切换变量
);
?>