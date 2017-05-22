<?php

/**
 * Created by PhpStorm.
 * This file is part of Notadd.
 *
 * @author Luqiang <345340585@qq.com>
 * @copyright (c) 2017, iLeyun.org
 * @Date: 17-5-13
 * @Time: 下午11:01
 */

namespace Notadd\ImagesManager\Injections;

use Illuminate\Container\Container;
use Notadd\Foundation\Module\Abstracts\Installer as AbstractInstaller;

/**
 * Class Uninstaller.
 */
class Installer extends AbstractInstaller
{
    /**
     * Installer constructor.
     *
     * @param \Illuminate\Container\Container $container
     */
    public function __construct(Container $container)
    {
        parent::__construct($container);
        $this->info->put('errors', $this->translator->trans('安装文章模块失败！'));
        $this->info->put('messages', $this->translator->trans('安装文章模块成功！'));
    }

    /**
     * @return bool
     */
    public function handle()
    {
        return true;
    }

    /**
     * @return array
     */
    public function require ()
    {
        return [];
    }
}

