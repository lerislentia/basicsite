<?php

namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

use App\Exceptions\AuthException;
use Mockery;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use Auth;

class ExampleTest extends TestCase
{
    protected $baseservicemock;
    protected $studentmock;
    protected $teachermock;

    public function setUp()
    {
        parent::setUp();
        $this->createApplication();
        // $this->baseservicemock = Mockery::mock('Eloquent', 'App\Services\BaseService');
        // $this->studentmock = Mockery::mock('Eloquent', 'App\Models\Locally\Student');
        // $this->teachermock = Mockery::mock('Eloquent', 'App\Models\Locally\Teacher');
        // $this->app->instance('App\Services\BaseService', $this->baseservicemock);
        // $this->app->instance('App\Models\Locally\Student', $this->studentmock);
        // $this->app->instance('App\Models\Locally\Teacher', $this->teachermock);
        Log::shouldReceive('info')->andReturn(null);
        Log::shouldReceive('error')->andReturn(null);
        Log::shouldReceive('debug')->andReturn(null);
    }


    public function test_index()
    {
        // $this->baseservicemock
        //             ->shouldReceive(
        //                 [
        //                     'getSlides'     => $this->baseservicemock,
        //                     'getArticles'   => $this->baseservicemock,
        //                 ]
        //             )->zeroOrMoreTimes();

        // $response = $this->call('GET', '/');

        // $this->assertEquals(Response::HTTP_OK, $response->status());
    }

    /**
     * A basic test example.
     *
     */
    public function testBasicTest()
    {
        // $response = $this->get('/');

        // $response->assertStatus(200);
    }

    public function tearDown()
    {
        parent::tearDown();
        Mockery::close();
    }
}
