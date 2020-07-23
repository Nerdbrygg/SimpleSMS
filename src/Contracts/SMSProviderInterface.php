<?php

namespace Nerdbrygg\SimpleSMS\Contracts;

use Nerdbrygg\SimpleSMS\SimpleSMS;

interface SMSProviderInterface
{
    public function send(SimpleSMS $sms);
}
