<?php

namespace Nerdbrygg\SimpleSMS\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class SMSTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(realpath(__DIR__.'../database/migrations'));

        Http::fake(function () {
            return Http::response('OK', 200);
        });
    }

    /** @test */
    public function it_encrypts_messages()
    {
        Config::set('simplesms.messages.encryption', true);

        $this->post(route('sms.store'), [
            'destination' => '4711111111',
            'message' => 'Test message',
        ]);

        $this->assertDatabaseHas('simplemessages', [
            'destination' => '4711111111',
        ]);

        $this->assertDatabaseMissing('simplemessages', ['message' => 'Test message']);
    }

    /** @test */
    public function it_doesnt_encrypt_messages()
    {
        Config::set('simplesms.messages.encryption', false);

        $this->post(route('sms.store', [
            'destination' => '4711111111',
            'message' => 'Test message',
        ]));

        $this->assertDatabaseHas('simplemessages', [
            'destination' => '4711111111',
            'message' => 'Test message',
        ]);
    }

    /** @test */
    public function it_stores_a_record_in_the_database()
    {
        Config::set('simplesms.messages.save', true);
        Config::set('simplesms.messages.encryption', false);

        $this->post(route('sms.store', [
            'destination' => '4711111111',
            'message' => 'Test message',
        ]));

        $this->assertDatabaseHas('simplemessages', [
            'destination' => '4711111111',
            'message' => 'Test message',
        ]);
    }

    /** @test */
    public function it_saves_the_source_in_the_database()
    {
        $this->post(route('sms.store', [
            'destination' => '4711111111',
            'message' => 'Test message',
            'source' => 'TheForce',
        ]));

        $this->assertDatabaseHas('simplemessages', [
            'source' => 'TheForce',
        ]);
    }
}
