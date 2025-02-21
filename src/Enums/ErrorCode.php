<?php

namespace Chine\UniformResponse\Enums;

use Chine\UniformResponse\Annotations\ErrorMeta;
use Chine\UniformResponse\Annotations\BaseErrorCode;
use ReflectionEnumUnitCase;
use RuntimeException;

enum ErrorCode: int
{
    use BaseErrorCode; // 引入 Trait

    #[ErrorMeta(httpStatusCode: 400, description: '请求错误', translationKey: 'error.bad_request')]
    case BAD_REQUEST = 400;

    #[ErrorMeta(httpStatusCode: 401, description: '未授权')]
    case UNAUTHORIZED = 401;

    #[ErrorMeta(httpStatusCode: 404, description: '资源未找到')]
    case NOT_FOUND = 404;

    #[ErrorMeta(httpStatusCode: 500, description: '服务器内部错误')]
    case INTERNAL_ERROR = 500;
}