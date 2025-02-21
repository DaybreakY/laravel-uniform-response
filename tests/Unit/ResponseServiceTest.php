<?php

namespace Tests\Unit;

use Chine\UniformResponse\Enums\ErrorCode;
use Chine\UniformResponse\ResponseService;
use Orchestra\Testbench\TestCase;


class ResponseServiceTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            \Chine\UniformResponse\UniformResponseServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'ResponseFacade' => \Chine\UniformResponse\Facades\ResponseFacade::class,
        ];
    }

    public function testOkResponse()
    {
        $responseService = new ResponseService();
        $response = $responseService->ok();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($response->getContent());
    }

    public function testSuccessResponse()
    {
        $responseService = new ResponseService();
        $response = $responseService->success(['foo' => 'bar']);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($response->getContent());
    }

    public function testErrorResponse()
    {
        $responseService = new ResponseService();
        $response = $responseService->error(0);
        $this->assertEquals(400, $response->getStatusCode());
        $this->assertJson($response->getContent());
    }

    public function testErrResponse()
    {
        $responseService = new ResponseService();
        $response = $responseService->err(ErrorCode::BAD_REQUEST);
        $this->assertEquals(400, $response->getStatusCode());
        $this->assertJson($response->getContent());
    }
}
