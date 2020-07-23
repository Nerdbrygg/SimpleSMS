<?php

namespace Nerdbrygg\SimpleSMS\Providers;

use Illuminate\Support\Facades\Http;
use Nerdbrygg\SimpleSMS\Contracts\SMSProviderInterface;
use Nerdbrygg\SimpleSMS\SimpleSMS;

class PSWinCom implements SMSProviderInterface
{
    public function send(SimpleSMS $sms)
    {
        $attributes = [
            'USER' => config('simplesms.pswincom.username'),
            'PW' => config('simplesms.pswincom.password'),
            'RCV' => $sms->getDestination(),
            'SND' => $sms->getSource(),
            'TXT' => $sms->getMessage()
        ];

        return Http::asForm()->post(config('simplesms.pswincom.uri'), $attributes);
    }
}
