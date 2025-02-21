# Laravel Uniform Response
`Laravel Uniform Response` 是一个用于统一 Laravel 应用程序响应格式的包。它提供了一致的响应结构，简化了 API 开发过程。

## 安装
### 通过 Composer 安装
你可以通过 Composer 安装这个包：

``` bash
composer require chine/uniform-response
```
### 本地离线安装
如果你需要在内部环境中离线使用这个包，可以按照以下步骤进行本地安装：
1. 克隆或下载包到本地：
将包克隆到你的本地项目目录中，例如：
``` bash
git clone https://github.com/DaybreakY/uniform-response.git
```
或者直接下载 ZIP 文件并解压到本地目录。
2. 将包添加到你的 `composer.json` 文件中：
在你的 `Laravel` 项目的 `composer.json` 文件中，添加本地路径依赖：
``` json
{
    "repositories": [
        {
            "type": "path",
            "url": "../path/to/laravel-uniform-response"
        }
    ],
    "require": {
        "chine/uniform-response": "^1.0"
    }
}
```
确保 url 指向你本地克隆或下载的包的路径。
3. 安装本地依赖包
运行以下命令来安装本地包：
``` bash
composer require chine/uniform-response
```
Composer 将会从本地路径安装包。
## 配置
### 服务提供者
在 `config/app.php` 中注册服务提供者（Laravel 5.5 及以上版本自动注册）：

``` php
'providers' => [
    // 其他服务提供者
    Chine\UniformResponse\UniformResponseServiceProvider::class,
],
```
### 别名
在 `config/app.php` 中注册别名（Laravel 5.5 及以上版本自动注册）：

``` php
'aliases' => [
    // 其他别名
    'ResponseFacade' => Chine\UniformResponse\Facades\ResponseFacade::class,
],
```
### 语言包配置
本包提供了中英文语言包示例(<font color="red">建议自己创建语言包</font>)，你可以通过以下命令发布语言文件：
``` bash
php artisan vendor:publish --provider="Chine\UniformResponse\UniformResponseServiceProvider" --tag="lang"
```
发布后的语言文件位于 resources/lang/vendor/chine-uniform-response 目录下。
### 响应格式
所有响应都将遵循以下 JSON 格式：
``` json
{
    "msg": "响应消息",
    "data": "响应数据",
    "code": "响应码（成功为0，错误时为具体错误码）"
}
```
## 使用
#### 响应服务
`ResponseService` 提供了多种方法来生成统一格式的响应。
##### 使用依赖注入
``` php
use Chine\UniformResponse\ResponseService;

class UserController extends Controller
{
    public function index(ResponseService $response)
    {
        return $response->success(['users' => []]);
    }
}
```
##### 使用 Facade
``` php
use ResponseFacade;

class UserController extends Controller
{
    public function index()
    {
        return ResponseFacade::success(['users' => []]);
    }
}
```
##### 成功响应
``` php
use Chine\UniformResponse\ResponseService;

$responseService = new ResponseService();

// 返回简单成功响应
$response = $responseService->ok();

// 返回带数据的成功响应
$response = $responseService->success(['foo' => 'bar']);

// 自定义成功消息
$response = $responseService->success(['foo' => 'bar'], '操作成功');
```
#### 错误响应
``` php
use Chine\UniformResponse\ResponseService;
use Chine\UniformResponse\Enums\ErrorCode;

$responseService = new ResponseService();

// 使用自定义错误码
$response = $responseService->error(0);

// 使用预定义错误码
$response = $responseService->err(ErrorCode::BAD_REQUEST);

// 带详细错误信息
$response = $responseService->err(
    ErrorCode::BAD_REQUEST,
    ['field' => 'username', 'message' => '用户名已存在']
);
```

## 枚举错误码
`ErrorCode` 枚举类定义了一些常见的错误码，方便在项目中使用。

``` php
use Chine\UniformResponse\Enums\ErrorCode;

// 400 请求错误
ErrorCode::BAD_REQUEST;

// 401 未授权
ErrorCode::UNAUTHORIZED;

// 404 资源未找到
ErrorCode::NOT_FOUND;

// 500 服务器内部错误
ErrorCode::INTERNAL_ERROR;
``` 
每个错误码都包含以下信息：

- HTTP 状态码
- 错误描述
- 国际化翻译键
- 日志级别
## 贡献
欢迎贡献代码！请遵循以下步骤：

1. Fork 项目
2. 创建你的功能分支 (git checkout -b feature/AmazingFeature)
3. 提交你的更改 (git commit -m 'Add some AmazingFeature')
4. 推送到分支 (git push origin feature/AmazingFeature)
5. 打开一个 Pull Request
## 许可证
本项目采用 `MIT` 许可证。
