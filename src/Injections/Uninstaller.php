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

use Notadd\Foundation\Module\Abstracts\Uninstaller as AbstractUninstaller;

/**
 * Class Uninstaller.
 */
class Uninstaller extends AbstractUninstaller
{

    /**
     * @return mixed
     */
    public function handle()
    {
        return true;
    }
}
