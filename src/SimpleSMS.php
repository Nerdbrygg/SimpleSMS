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
     * @var string
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

    public function send(array $sms)
    {
        $this->message = $sms['message'];
        $this->provider = config('simplesms.default.provider');
        $this->destination = NumberParser::parse($sms['destination']);
        $this->source = isset($sms['source']) ?: config('simplesms.default.source');

        return ((new ProviderRepository)->make($this->provider))::handle($this);
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

    /**
     * Create a new instance of SimpleSMS.
     *
     * @param string $provider
     */
/*     public function __construct($provider = null)
    {
        if (is_null($this->source)) {
            $this->source = config('simplesms.default.source');
        }

        if (!is_null($provider)) {
            return $this->provider = $provider;
        }

        return $this->provider = config('simplesms.default.provider');
    }
 */
    /**
     * Specify the telephone number to send to.
     *
     * @param string $destination
     * @return self
     */
/*     public function to(string $destination)
    {
        $this->destination = $destination;

        return $this;
    } */

    /**
     * Specify the telephone number to send from.
     *
     * @param string $source
     * @return self
     */
/*     public function from(string $source)
    {
        $this->source = $source;

        return $this;
    } */

    /**
     * Specify the message to send.
     *
     * @param string $message
     * @return self
     */
/*     public function message(string $message)
    {
        $this->message = $message;

        return $this;
    } */

    /**
     * Gets the destination.
     *
     * @return string $destination
     */
/*     public function getDestination()
    {
        return $this->destination;
    } */

    /**
     * Gets the source.
     *
     * @return string $source
     */
/*     public function getSource()
    {
        return $this->source;
    } */

    /**
     * Gets the message.
     *
     * @return string $message
     */
/*     public function getMessage()
    {
        return $this->message;
    } */

    /**
     * Send the message.
     *
     * @return bool
     */
/*     public function send()
    {
        if (is_null($this->message)) {
            throw new MissingParameter('Please provide a message.');
        }

        if (is_null($this->destination)) {
            throw new MissingParameter('Please provide a destination');
        }

        return ((new ProviderRepository)->make($this->provider))->send($this);
    } */
}
