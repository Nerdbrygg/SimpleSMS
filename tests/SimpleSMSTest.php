<?php

use Illuminate\Support\Facades\Http;
use Nerdbrygg\SimpleSMS\Exceptions\MissingParameter;
use Nerdbrygg\SimpleSMS\Exceptions\ProviderNotFound;
use Nerdbrygg\SimpleSMS\Facades\SimpleSMS;
use Nerdbrygg\SimpleSMS\SimpleSMS as SimpleSMSClass;
use PHPUnit\Framework\TestCase;

class SimpleSMSTest extends TestCase
{
    /** @test */
    public function it_must_have_a_message()
    {
        $this->expectException(MissingParameter::class);

        SimpleSMS::to('4711111111')->send();
    }

    /** @test */
    public function it_must_have_a_destination()
    {
        $this->expectException(MissingParameter::class);

        SimpleSMS::message('Hello World.')->send();
    }

    /** @test */
    public function it_must_have_a_valid_provider()
    {
        $this->expectException(ProviderNotFound::class);

        $sms = new SimpleSMSClass('Non-existing-provider');

        $sms->message('Hello World.')->to('4711111111')->send();
    }

    /** @test */
    public function it_sends_an_sms()
    {
        Http::fake(function () {
            return Http::response('OK', 200);
        });

        $response = SimpleSMS::to('4711111111')->message('Hello World.')->send();

        $this->assertInstanceOf(Illuminate\Http\Client\Response::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
    }
}
