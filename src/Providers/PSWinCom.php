<?php

namespace Nerdbrygg\SimpleSMS\Providers;

use GuzzleHttp\Client;
use Nerdbrygg\SimpleSMS\Contracts\SMSProviderInterface;
use Nerdbrygg\SimpleSMS\SimpleSMS;
use Nerdbrygg\SimpleSMS\Support\XMLParser;

class PSWinCom implements SMSProviderInterface
{
    protected const ENDPOINT_URI = 'https://xml.pswin.com';

    public static function handle(SimpleSMS $sms)
    {
        return (new static)->create($sms);
    }

    public function send($message)
    {
        $client = new Client();

        $options = [
            'headers' => [
                'Content-Type' => 'text/xml; charset=utf-8',
                'Content-Length' => strlen($message),
            ],
            'body' => $message,
        ];

        return $client->post(self::ENDPOINT_URI, $options);
    }

    protected function create($sms)
    {
        $messages = $sms->destination()->map(function ($number) use ($sms) {
            return [
                'text' => $sms->message(),
                'snd' => $sms->source(),
                'rcv' => $number,
            ];
        })->toArray();

        $session = [
            'session' => [
                'client' => config('simplesms.provider.username'),
                'pw' => config('simplesms.provider.password'),
                'msglst' => $messages,
            ],
        ];

        return $this->send(XMLParser::parse($session));
    }
}
