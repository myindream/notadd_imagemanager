<?php
/**
 * Created by PhpStorm.
 * This file is part of Notadd.
 *
 * @author Luqiang <345340585@qq.com>
 * @copyright (c) 2017, iLeyun.org
 * @Time 2017-05-22 19:40
 */
namespace Notadd\ImagesManager\Listeners;

use Notadd\Foundation\Event\Abstracts\EventSubscriber;
use Notadd\Foundation\Http\Events\CsrfTokenRegister as CsrfTokenRegisterEvent;

/**
 * Class CsrfTokenRegister.
 */
class CsrfTokenRegister extends EventSubscriber
{
    /**
     * Name of event.
     *
     * @throws \Exception
     * @return string|object
     */
    protected function getEvent()
    {
        return CsrfTokenRegisterEvent::class;
    }

    /**
     * Register excepts.
     *
     * @param $event
     */
    public function handle(CsrfTokenRegisterEvent $event)
    {
        $event->registerExcept('api/images*');
    }
}
