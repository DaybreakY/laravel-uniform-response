<?php

namespace Chine\UniformResponse\Annotations;

use Chine\UniformResponse\Annotations\ErrorMeta;
// use ReflectionEnumBackedCase;
use ReflectionEnumUnitCase;
use RuntimeException;

trait BaseErrorCode
{
    /**
     * 获取注解元信息
     */
    public function meta(): ErrorMeta
    {
        
        // $reflection = new ReflectionEnumBackedCase($this::class, $this->name);
        $reflection = new ReflectionEnumUnitCase($this::class, $this->name);
        // 获取注解
        $attributes = $reflection->getAttributes(ErrorMeta::class);

        // 为空时抛出异常
        if (empty($attributes)) {
            throw new RuntimeException("ErrorMeta annotation not found for {$this->name}");
        }

        return $attributes[0]->newInstance();
    }
}