<?php
/**
 * Created by PhpStorm.
 * @User: luqiang<345340585@qq.com>
 * @Date: 17-5-10
 * @Time: 下午11:01
 */

namespace Notadd\ImagesManager\Controllers\Api\ImagesManager;



use Notadd\ImagesManager\Handlers\deleteHandler;
use Notadd\ImagesManager\Handlers\GetHandler;
use Notadd\ImagesManager\Handlers\UploadHandler;

class ImagesManagerController
{
    public function upload(UploadHandler $handler)
    {
        header("Access-Control-Allow-Origin: *");
        return $handler->toResponse()->generateHttpResponse();
    }

    public function lists(GetHandler $handler)
    {
        return $handler->toResponse()->generateHttpResponse();
    }

    public function delete(deleteHandler $deleteHander){
        return $deleteHander->toResponse()->generateHttpResponse();
    }

    private function mk_dir($dir, $mode = 0755)
    {
        if (is_dir($dir) || @mkdir($dir,$mode)) return true;
        if (!$this->mk_dir(dirname($dir),$mode)) return false;
        return @mkdir($dir,$mode);
    }
}