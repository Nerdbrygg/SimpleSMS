<?php

namespace Nerdbrygg\SimpleSMS;

use Nerdbrygg\SimpleSMS\Exceptions\MissingParameter;
use Nerdbrygg\SimpleSMS\Providers\ProviderRepository;
use Nerdbrygg\SimpleSMS\Support\NumberParser;

class SimpleSMS
{
    /**
     * @var string
     */
    protected $message;

    /**
     * @var \Illuminate\Support\Collection
     */
    protected $destination;

    /**
     * @var string
     */
    protected $source;

    /**
     * @var string
     */
    protected $provider;

    public function __construct($sms)
    {
        $this->message = $sms['message'];
        $this->provider = config('simplesms.default.provider');
        $this->destination = NumberParser::parse($sms['destination']);
        $this->source = isset($sms['source']) ? $sms['source'] : config('simplesms.default.source');
    }

    public static function create(array $sms)
    {
        return (new static($sms));
    }

    public function source()
    {
        return $this->source;
    }

    public function message()
    {
        return $this->message;
    }

    public function destination()
    {
        return $this->destination;
    }

    public function save($response)
    {
        return $this->destination->each(function ($number) use ($response) {
            SMS::create([
                'user_id' => auth()->id() ?: null,
                'source' => $this->source,
                'destination' => $number,
                'status' => $response->getReasonPhrase(), // TODO: get status of spesific message.
                'message' => (config('simplesms.messages.encrypt')) ? encrypt($this->message) : $this->message,
            ]);
        });
    }

    public function send()
    {
        if (is_null($this->message)) {
            throw new MissingParameter('Please provide a message.');
        }

        if (is_null($this->destination)) {
            throw new MissingParameter('Please provide a destination');
        }

        $response = (ProviderRepository::make($this->provider))::handle($this);

        if (config('simplesms.messages.save')) {
            $this->save($response);
        }

        return $response;
    }
}
