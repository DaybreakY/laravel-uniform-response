<?php

namespace Chine\UniformResponse\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Chine\UniformResponse\ResponseService
 */
class ResponseFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'uniform-response';
    }
}
