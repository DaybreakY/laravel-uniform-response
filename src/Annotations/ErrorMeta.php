<?php

namespace Chine\UniformResponse\Annotations;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT|Attribute::TARGET_CLASS)]
class ErrorMeta
{
    public function __construct(
        public int $httpStatusCode, // HTTP 状态码
        public ?string $description = null, // 错误描述
        public ?string $translationKey = null, // 错误描述
        public string $logLevel = 'error', // 日志级别
    ) {
    }
}