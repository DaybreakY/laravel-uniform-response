<?php

namespace Chine\UniformResponse;

use Illuminate\Http\JsonResponse;
use UnitEnum;
use Chine\UniformResponse\Annotations\BaseErrorCode;

class ResponseService
{
    /**
     * 返回成功的 JSON 响应
     * @return JsonResponse
     */
    public function ok(): \Illuminate\Http\JsonResponse
    {
        return $this->success();
    }

    /**
     * 返回失败的 JSON 响应
     * @param UnitEnum $errorCode 错误码
     * @param mixed|null $errors 错误信息
     * @param string|null $message 错误描述
     * @return JsonResponse
     */
    public function err(UnitEnum $errorCode, mixed $errors = null, ?string $message = null): \Illuminate\Http\JsonResponse
    {
        // 确保传入的枚举类使用了 BaseErrorCode
        if (!in_array(BaseErrorCode::class, class_uses($errorCode::class), false)) {
            throw new \InvalidArgumentException('The provided enum must use the BaseErrorCode trait.');
        }

        $meta = $errorCode->meta();
        if (empty($message)) {
            // 尝试从翻译文件中获取错误描述
            $trans_msg = (string)__($meta->translationKey);
            $message = ($trans_msg === $meta->translationKey) ? $meta->description : $trans_msg;
        }

        // 返回错误响应
        return $this->error(code: $errorCode->value, message: $message, statusCode: $meta->httpStatusCode, errors: $errors);
    }

    /**
     * 返回成功的 JSON 响应
     *
     * @param mixed|null $data
     * @param string $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function success(mixed $data = null, string $message = 'Success', int $statusCode = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'msg' => $message,
            'data' => $data,
            'code' => 0,
        ], $statusCode);
    }

    /**
     * 返回失败的 JSON 响应
     *
     * @param int $code
     * @param string $message
     * @param int $statusCode
     * @param mixed|null $errors
     * @return \Illuminate\Http\JsonResponse
     */
    public function error(int $code, string $message = 'Error', int $statusCode = 400, mixed $errors = null): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'msg' => $message,
            'data' => $errors,
            'code' => $code,
        ], $statusCode);
    }
}
