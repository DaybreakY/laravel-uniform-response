<?php

namespace Chine\UniformResponse;

use Illuminate\Support\ServiceProvider;

class UniformResponseServiceProvider extends ServiceProvider
{
    /**
     * 注册服务
     */
    public function register()
    {
        $this->app->bind('uniform-response', function () {
            return new ResponseService();
        });
    }

    /**
     * 启动服务
     */
    public function boot()
    {
        // 如果需要发布配置文件或其他资源，可以在这里处理

         // 发布语言文件
         $this->publishes([
            __DIR__.'/../lang' => lang_path('vendor/chine-uniform-response'),
        ], 'lang');
    }
}
