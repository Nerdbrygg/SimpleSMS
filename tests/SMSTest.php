<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\TestCase;
use Tests\CreatesApplication;

class SMSTest extends TestCase
{
    use RefreshDatabase,
        CreatesApplication;

    /** @test */
    public function it_stores_a_record_in_the_database()
    {
        Http::fake(function () {
            return Http::response('OK', 200);
        });

        $this->post(route('sms.store', [
            'destination' => '4711111111',
            'message' => 'Test message'
        ]));

        $this->assertDatabaseCount('simplemessages', 1);
    }

    /** @test */
    public function it_encrypts_messages()
    {
        Http::fake(function () {
            return Http::response('OK', 200);
        });

        Config::set('simplesms.messages.encryption', true);

        $this->post(route('sms.store', [
            'destination' => '4711111111',
            'message' => 'Test message'
        ]));

        $this->assertDatabaseMissing('simplemessages', ['message' => 'Test message']);
    }

    /** @test */
    public function it_doesnt_encrypt_messages()
    {
        Http::fake(function () {
            return Http::response('OK', 200);
        });

        Config::set('simplesms.messages.encryption', false);

        $this->post(route('sms.store', [
            'destination' => '4711111111',
            'message' => 'Test message'
        ]));

        $this->assertDatabaseHas('simplemessages', ['message' => 'Test message']);
    }
}
