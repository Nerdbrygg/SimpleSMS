<?php

namespace Nerdbrygg\SimpleSMS\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Nerdbrygg\SimpleSMS\Tests\TestCase;

class SMSTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(realpath(__DIR__.'../database/migrations'));

        Config::set('simplesms.messages.save', true);

        Http::fake(function () {
            return Http::response('OK', 200);
        });
    }

    public function it_encrypts_messages()
    {
        Config::set('simplesms.messages.encrypt', true);

        $this->post(route('sms.store'), [
            'destination' => '4711111111',
            'message' => 'Test message',
        ]);

        $this->assertDatabaseHas('simplemessages', [
            'destination' => '4711111111',
        ]);

        $this->assertDatabaseMissing('simplemessages', ['message' => 'Test message']);
    }

    public function it_doesnt_encrypt_messages()
    {
        Config::set('simplesms.messages.encrypt', false);

        $this->post(route('sms.store'), [
            'destination' => '4711111111',
            'message' => 'Test message',
        ]);

        $this->assertDatabaseHas('simplemessages', [
            'destination' => '4711111111',
            'message' => 'Test message',
        ]);
    }

    /** @test */
    public function it_stores_a_record_in_the_database()
    {
        $this->post(route('sms.store'), [
            'destination' => '4711111111',
            'message' => 'Test message',
        ]);

        $this->assertDatabaseHas('simplemessages', [
            'destination' => '4711111111',
        ]);
    }

    public function it_saves_the_source_in_the_database()
    {
        $this->post(route('sms.store'), [
            'destination' => '4711111111',
            'message' => 'Test message',
            'source' => 'TheForce',
        ]);

        $this->assertDatabaseHas('simplemessages', [
            'source' => 'TheForce',
        ]);
    }

    public function it_can_send_to_multiple_receivers()
    {
        Config::set('simplesms.messages.encrypt', false);

        $this->post(route('sms.store'), [
            'destination' => '11111111, 4722222222',
            'message' => 'Test message',
            'source' => 'TheForce',
        ]);

        $this->assertDatabaseCount('simplemessages', 2);

        $this->assertDatabaseHas('simplemessages', [
            'destination' => '4711111111',
            'message' => 'Test message',
        ]);

        $this->assertDatabaseHas('simplemessages', [
            'destination' => '4722222222',
            'message' => 'Test message',
        ]);
    }
}
