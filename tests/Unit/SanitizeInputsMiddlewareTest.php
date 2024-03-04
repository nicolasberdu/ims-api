<?php

namespace Tests\Unit;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PHPUnit\Framework\TestCase;
use App\Http\Middleware\SanitizeInputs;

class SanitizeInputsMiddlewareTest extends TestCase
{

    public function testSanitizeInputs(){
        $middleware = new SanitizeInputs();

        $request = Request::create('/test', 'POST', [
            'input_field' => '<script>alert("XSS")</script>',
        ]);

        $response = $middleware->handle($request, fn() => new Response());

        $this->assertEquals('alert("XSS")', $request->input('input_field'));
    }
}
