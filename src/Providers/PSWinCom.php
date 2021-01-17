<?php

namespace Nerdbrygg\SimpleSMS\Providers;

use Illuminate\Support\Facades\Http;
use Nerdbrygg\SimpleSMS\Contracts\SMSProviderInterface;
use Nerdbrygg\SimpleSMS\SimpleSMS;

class PSWinCom implements SMSProviderInterface
{
    protected const ENDPOINT_URI = 'https://simple.pswin.com/';
    //protected const XMLFILE_PATH = 'Extras\PSWinCom.xml';
    //protected const ENDPOINT_XML_URI = 'https://xml.pswin.com/';

    public static function handle(SimpleSMS $sms)
    {
        return (new static)->create($sms);
    }

    public function send($message)
    {
        return Http::asForm()->post(self::ENDPOINT_URI, $message);
    }

    protected function create($sms)
    {
        $messages = $sms->destination()->map(function ($number) use ($sms) {
            return [
                'text' => $sms->message(),
                'snd' => $sms->source(),
                'rcv' => $number
            ];
        })->toArray();

        $session = [
            'session' => [
                'client' => 'username',
                'pw' => 'password',
                'msglst' => $messages
            ]
        ];

        dd($session);
    }
}
