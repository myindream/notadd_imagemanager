<?php
/**
 * This file is part of Notadd.
 *
 * @author Luqiang <345340585@qq.com>
 * @copyright (c) 2017, iLeyun.org
 * @datetime 2017-05-22 20:30
 */
namespace Notadd\ImagesManager;

use Illuminate\Events\Dispatcher;
use Notadd\ImagesManager\Listeners\CsrfTokenRegister;
use Notadd\ImagesManager\Listeners\RouteRegister;
use Notadd\Foundation\Extension\Abstracts\Extension as AbstractExtension;

/**
 * Class Extension.
 */
class Extension extends AbstractExtension
{
    /**
     * Boot provider.
     */
    public function boot()
    {
        $this->app->make(Dispatcher::class)->subscribe(CsrfTokenRegister::class);
        $this->app->make(Dispatcher::class)->subscribe(RouteRegister::class);

        $this->loadMigrationsFrom(realpath(__DIR__ . '/../databases/migrations'));
        $this->loadTranslationsFrom(realpath(__DIR__ . '/../resources/translations'), 'ImagesManager');
        $this->publishes([
            realpath(__DIR__ . '/../resources/mixes/administration/dist/assets/extensions/images-manager') => public_path('assets/extensions/images-manager'),
        ], 'public');
    }

    /**
     * Description of extension
     *
     * @return string
     */
    public static function description()
    {
        return '图片上传管理。';
    }

    /**
     * Installer for extension.
     *
     * @return \Closure
     */
    public static function install()
    {
        return function () {
            return true;
        };
    }

    /**
     * Name of extension.
     *
     * @return string
     */
    public static function name()
    {
        return '图片管理';
    }

    /**
     * Get script of extension.
     *
     * @return string
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public static function script()
    {
        return asset('assets/extensions/images-manager/js/extension.min.js');
    }

    /**
     * Get stylesheet of extension.
     *
     * @return array
     */
    public static function stylesheet()
    {
        return [
            asset('assets/extensions/images-manager/css/extension.min.css'),
        ];
    }

    /**
     * Uninstall for extension.
     *
     * @return \Closure
     */
    public static function uninstall()
    {
        return function () {
            return true;
        };
    }

    /**
     * Version of extension.
     *
     * @return string
     */
    public static function version()
    {
        return '0.1.0';
    }


    public static function migrations() {
        return static::$migrations->toArray();
    }
}
