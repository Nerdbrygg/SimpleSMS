<?php

namespace Nerdbrygg\SimpleSMS\Tests\Unit;

use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Nerdbrygg\SimpleSMS\Exceptions\MissingParameter;
use Nerdbrygg\SimpleSMS\Exceptions\ProviderNotFound;
use Nerdbrygg\SimpleSMS\SimpleSMS;
use Nerdbrygg\SimpleSMS\Tests\TestCase;

class SimpleSMSTest extends TestCase
{
    /** @test */
    public function it_must_have_a_message()
    {
        $this->expectException(MissingParameter::class);

        SimpleSMS::create(['message' => null, 'destination' => '4712345678'])->send();
    }

    /** @test */
    public function it_must_have_a_destination()
    {
        $this->expectException(MissingParameter::class);

        SimpleSMS::create(['message' => 'Hello World.', 'destination' => null])->send();
    }

    /** @test */
    public function it_must_have_a_valid_provider()
    {
        $this->expectException(ProviderNotFound::class);

        Config::set('simplesms.default.provider', 'Non-Existing-Provider');

        SimpleSMS::create(['message' => 'Hello World.', 'destination' => '4712345678'])->send();
    }

    /** @test */
    public function it_sends_an_sms()
    {
        Http::fake(function () {
            return Http::response('OK', 200);
        });

        Config::set('simplesms.messages.save', false);

        $response = SimpleSMS::create(['message' => 'Hello World.', 'destination' => '4712345678'])->send();

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function it_can_change_the_source()
    {
        $message = SimpleSMS::create(['message' => 'Hello World.', 'destination' => '4712345678', 'source' => '4712345678']);

        $this->assertEquals('4712345678', $message->source());
    }
}
