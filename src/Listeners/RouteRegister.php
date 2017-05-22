<?php
/**
 * This file is part of Notadd.
 *
 * @author Luqiang <345340585@qq.com>
 * @copyright (c) 2017, iLeyun.org
 * @datetime 2017-05-22 20:30
 */
namespace Notadd\ImagesManager  \Listeners;

use Notadd\Foundation\Routing\Abstracts\RouteRegister as AbstractRouteRegister;
use Notadd\ImagesManager\Controllers\Api\ImagesManager\ImagesManagerController;

/**
 * Class RouteRegister.
 */
class RouteRegister extends AbstractRouteRegister
{
    /**
     * Handle Route Registrar.
     */
    public function handle()
    {
        $this->router->group(['prefix' => 'api/sss'], function () {
            $this->router->post('upload', ImagesManagerController::class . '@upload');//上传文件
        });
        $this->router->group(['middleware' => ['auth:api', 'cross', 'web'], 'prefix' => 'api/administration/images'], function () {
            $this->router->post('upload', ImagesManagerController::class . '@admin_upload');//管理员上传文件
            $this->router->delete('delete', ImagesManagerController::class . '@admin_delete');//管理员删除文件
            $this->router->put('used', ImagesManagerController::class . '@admin_used');//通过审核
            $this->router->put('unused', ImagesManagerController::class . '@admin_unused');//不通过审核

            $this->router->group(['prefix'=>'config'],function(){
                $this->router->get('get', ImagesManagerController::class . '@admin_get_config');//配置
                $this->router->put('set', ImagesManagerController::class . '@admin_set_config');//配置
            });
        });
        $this->router->group(['middleware' => ['auth:api', 'cross', 'web'],'prefix' => 'api/imagemanager'], function () {
            $this->router->post('upload', ImagesManagerController::class . '@upload');//上传文件
            $this->router->delete('delete', ImagesManagerController::class . '@delete');//删除文件
            $this->router->delete('appeal', ImagesManagerController::class . '@appeal');//申诉文件
        });
        $this->router->group(['middleware' => ['auth:api', 'cross', 'web'],'prefix' => 'api/images'], function () {
            $this->router->get('lists', ImagesManagerController::class . '@lists');//读取文件列表
        });


//        $this->router->any('api/imagemanager/upload', ImagesManagerController::class . '@upload');//上传文件
    }
}
