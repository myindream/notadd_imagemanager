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
use Notadd\Foundation\Passport\Abstracts\DataHandler;
use Notadd\Foundation\Setting\Contracts\SettingsRepository;
use Notadd\ImagesManager\Models\FileImage;

/**
 * Class GetHandler.
 */
class GetHandler extends DataHandler
{

    /**
     * @var \Notadd\Foundation\Setting\Contracts\SettingsRepository
     */
    protected $settings;
    /**
     * @var \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    protected $pagination;


    public function __construct(
        FileImage $fileImage,
        Container $container
    ){
        parent::__construct($container);
        $this->errors->push($this->translator->trans('ImagesManager::lists.fail'));
        $this->messages->push($this->translator->trans('ImagesManager::lists.success'));
        $this->model = $fileImage;
    }

    /**
     * Data for handler.
     *
     * @return array
     */
    public function data()
    {
//        $pagenation = $this->request->input('pagenation',10);
//        return FileImage::where('enabled',FileImage::USED)->paginate($pagenation);
        $pagination = $this->request->input('pagination') ?: 16;
        $this->pagination = $this->model->newQuery()->where('enabled',FileImage::USED)->orderBy('created_at', 'desc')->paginate($pagination);
        return $this->pagination->items();
    }

    public function toResponse()
    {
        $response = parent::toResponse();

        return $response->withParams([
            'pagination' => [
                'total'         => $this->pagination->total(),
                'per_page'      => $this->pagination->perPage(),
                'current_page'  => $this->pagination->currentPage(),
                'last_page'     => $this->pagination->lastPage(),
                'next_page_url' => $this->pagination->nextPageUrl(),
                'prev_page_url' => $this->pagination->previousPageUrl(),
                'from'          => $this->pagination->firstItem(),
                'to'            => $this->pagination->lastItem(),
            ],
        ]);
    }
}
