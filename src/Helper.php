<?php

/**
 * @desc Helper
 * @author Tinywan(ShaoBo Wan)
 * @date 2022/4/10 9:45
 */
declare(strict_types=1);

use Webman\Config;

if (function_exists('app')) {
    \app('hook')->add('app_init', AppInit::class);
    if (Config::get('app.app_debug') && Config::get('app.app_trace')) {
        $hook = \app('hook')->add('app_end', AppEnd::class);
    }
}

if (!function_exists('soar')) {
    /**
     * @return object
     */
    function soar()
    {
        if (!Config::get('app.app_debug') || !Config::get('app.app_trace')) {
            throw new \Tinywan\Soar\Exception\InvalidConfigException(sprintf('Config must be true :[%s/%s]', 'app_debug', 'app_trace'));
        }

        return Facade::make(\Tinywan\Soar\Soar::class, [Config::get('soar.')]);
    }
}

if (!function_exists('soar_score')) {
    /**
     * @param null $sql
     * @return mixed
     */
    function soar_score($sql = null)
    {
        return null === $sql ? soar()->score(\think\facade\Db::getLastSql()) : soar()->score($sql);
    }
}

if (!function_exists('soar_md_explain')) {
    /**
     * @param null $sql
     * @return mixed
     */
    function soar_md_explain($sql = null)
    {
        return null === $sql ? soar()->mdExplain(\think\facade\Db::getLastSql()) : soar()->mdExplain($sql);
    }
}

if (!function_exists('soar_html_explain')) {
    /**
     * @param null $sql
     * @return mixed
     */
    function soar_html_explain($sql = null)
    {
        return null === $sql ? soar()->htmlExplain(\think\facade\Db::getLastSql()) : soar()->htmlExplain($sql);
    }
}

if (!function_exists('soar_syntax_check')) {
    /**
     * @param null $sql
     * @return mixed
     */
    function soar_syntax_check($sql = null)
    {
        return null === $sql ? soar()->syntaxCheck(\think\facade\Db::getLastSql()) : soar()->syntaxCheck($sql);
    }
}

if (!function_exists('soar_finger_print')) {
    /**
     * @param null $sql
     * @return mixed
     */
    function soar_finger_print($sql = null)
    {
        return null === $sql ? soar()->fingerPrint(\think\facade\Db::getLastSql()) : soar()->fingerPrint($sql);
    }
}

if (!function_exists('soar_pretty')) {
    /**
     * @param null $sql
     * @return mixed
     */
    function soar_pretty($sql = null)
    {
        return null === $sql ? soar()->pretty(\think\facade\Db::getLastSql()) : soar()->pretty($sql);
    }
}

if (!function_exists('soar_md2html')) {
    /**
     * @param $markdown
     * @return mixed
     */
    function soar_md2html($markdown)
    {
        return  soar()->md2html($markdown);
    }
}

if (!function_exists('soar_exec')) {
    /**
     * @param $command
     * @return mixed
     */
    function soar_exec($command)
    {
        return soar()->exec($command);
    }
}

if (!function_exists('soar_help')) {
    /**
     * @return mixed
     */
    function soar_help()
    {
        return soar()->help();
    }
}