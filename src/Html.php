<?php
/**
 * @desc Html
 * @author Tinywan(ShaoBo Wan)
 * @date 2022/4/10 9:45
 */
declare(strict_types=1);

namespace Tinywan\Soar;

use support\Log;

class Html
{
    /**
     * @var string
     */
    protected $file = __DIR__.'/Tpl/soar.tpl';

    /**
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @return false|string
     *
     */
    public function getHtmlContent()
    {
        $soars = $this->getSqlInfo();
        ob_start();
        include $this->getFile();

        return ob_get_clean();
    }

    /**
     * @return array
     *
     */
    public function getSqlInfo()
    {
        $sqls = array_key_exists('sql', Log::getLog()) ? Log::getLog('sql') : [];
        if (empty($sqls)) {
            return [];
        }
        $soar = soar();
        $soars = [];
        foreach ($sqls as $k => $sql) {
            preg_match_all('/\[ SQL \]|\[\sRunTime:.*\s\]/', $sql, $arr);
            if (!empty($arr[0])) {
                $sqlStr = preg_replace('/\[ SQL \]|\[\sRunTime:.*\s\]/', '', $sql);
                $soars[$k]['sql'] = $sqlStr;
                $soars[$k]['run_time'] = $arr[0][1];
                $soars[$k]['score'] = $soar->score($sqlStr);
                preg_match_all('/<p>.*分<\/p>/u', $soar->score($sqlStr), $stars);
                $soars[$k]['star'] = rtrim(ltrim($stars[0][0], '<p>'), '</p>');

                try {
                    $soars[$k]['htmlExplain'] = $soar->htmlExplain($sqlStr);
                } catch (\Exception $e) {
                    trace("EXPLAIN $sqlStr error: ".$e->getMessage());
                }
            }
        }

        return $soars;
    }
}