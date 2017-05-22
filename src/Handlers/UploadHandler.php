<?php
/**
 * This file is part of Notadd.
 *
 * @author Luqiang <345340585@qq.com>
 * @copyright (c) 2017, iLeyun.org
 * @datetime 2017-05-22 20:30
 */
namespace Notadd\ImagesManager\Handlers;

use Illuminate\Container\Container;
use Illuminate\Support\Facades\Validator;
use Notadd\Foundation\Passport\Abstracts\SetHandler as AbstractSetHandler;
use Notadd\Foundation\Setting\Contracts\SettingsRepository;
use Notadd\Foundation\Validation\ValidatesRequests;
use Notadd\ImagesManager\Models\FileImage;

/**
 * Class ConfigurationHandler.
 */
class UploadHandler extends AbstractSetHandler
{
    /**
     * @var \Notadd\Foundation\Setting\Contracts\SettingsRepository
     */
    protected $settings;

    /**
     * SetHandler constructor.
     *
     * @param \Illuminate\Container\Container                         $container
     * @param \Notadd\Foundation\Setting\Contracts\SettingsRepository $settings
     */
    public function __construct(
        Container $container,
        SettingsRepository $settings
    ) {
        parent::__construct($container);
        $this->settings = $settings;
    }

    /**
     * Data for handler.
     *
     * @return array
     */
    public function data()
    {
        $file = FileImage::where('user_id',0)->select('path','id','title')->get()->toArray();
        return $file;
    }

    /**
     * Execute Handler.
     *
     * @return bool
     */
    public function execute()
    {
        $file = $this->request->file('uploadFile');//
        $hash = '';
        if($file)
        $hash = hash_file('md5',$file->path());
        $path = 'uploads/images';//文件保存路径
//        Validator::extend('empty', function($attribute, $value, $parameters, $validator) {
//            if (!empty($value)) {
//                dd($value);
//                die;
//                return true;
//            }
//        });
        $validator = Validator::make(['hash'=>$hash], [
//            'hash' => 'exists:file_images.hash,file_images.user_id,' . 0,
            'hash'=>'required|unique:file_images,hash,user_id,0'
        ], [
            'hash.unique' => $this->translator->trans('ImagesManager::upload.exists'),
//            'hash.empty' => $this->translator->trans('ImagesManager::upload.empty'),
            'hash.required' => $this->translator->trans('ImagesManager::upload.empty'),
        ]);

//
        if ($validator->fails()) {
            //
            $this->throwValidationException($this->request, $validator);
        }



        if(empty($file)){
            $this->messages->push($this->translator->trans('ImagesManager::upload.fail'));
            return false;
        }

        $filePath = $file->storePublicly($path,['disk'=>'public']);//文件存储引擎
        $FilesImage = new FileImage();
        $FilesImage->path = $filePath;
        $FilesImage->hash = $hash;
        $FilesImage->user_id = 0;

        //存储文件信息到数据库
        if($FilesImage->saveOrFail())
            $this->messages->push($this->translator->trans('ImagesManager::upload.success'));

        return true;
    }
}
