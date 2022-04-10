<?php

return [
    // soar 路径
    '-soar-path'   => 'you_soar_path',
    // 线上环境配置
    '-online-dsn'  => [
        'host'     => '',
        'port'     => '',
        'dbname'   => '',
        'username' => '', // 线上数据库用户只需 select 权限
        'password' => '',
        'disable'  => true,
    ],
    // 测试环境配置
    '-test-dsn'    => [
        'host'     => config('thinkorm.hostname') ? config('thinkorm.hostname') : 'you_host',
        'port'     => config('thinkorm.hostport') ? config('thinkorm.hostport') : 'you_port',
        'dbname'   => config('thinkorm.database') ? config('thinkorm.database') : 'you_dbname',
        'username' => config('thinkorm.username') ? config('thinkorm.username') : 'you_username',
        'password' => config('thinkorm.password') ? config('thinkorm.password') : 'you_password',
        'disable'  => false,
    ],
    // 日志输出文件
    '-log-output'  => runtime_path() . DIRECTORY_SEPARATOR . 'soar.log',
    // 日志级别: [0=>Emergency, 1=>Alert, 2=>Critical, 3=>Error, 4=>Warning, 5=>Notice, 6=>Informational, 7=>Debug]
    '-log-level'   => 7,
    // 报告输出格式: [markdown, html, json]
    '-report-type' => 'html',
];