<?php

namespace Nerdbrygg\SimpleSMS\Tests\Unit;

use DOMDocument;
use Nerdbrygg\SimpleSMS\Support\XMLParser;
use Nerdbrygg\SimpleSMS\Tests\TestCase;

class XMLParserTest extends TestCase
{
    /** @test */
    public function it_parses_an_array_with_a_single_message()
    {
        $message = [
            'session' => [
                'client' => 'username',
                'pw' => 'password',
                'msglst' => [
                    0 => [
                        'id' => 1,
                        'snd' => 'sender',
                        'rcv' => 'receiver',
                        'text' => 'text',
                    ],
                ],
            ],
        ];
        $expected = "<?xml version=\"1.0\"?><SESSION><CLIENT>username</CLIENT><PW>password</PW><MSGLST><MSG><ID>1</ID><SND>sender</SND><RCV>receiver</RCV><TEXT>text</TEXT></MSG></MSGLST></SESSION>";
        $expected = $this->formatXML($expected);

        $this->assertEquals($expected, XMLParser::parse($message));
    }

    /** @test */
    public function it_parses_an_array_with_multiple_messages()
    {
        $messages = [
            'session' => [
                'client' => 'username',
                'pw' => 'password',
                'msglst' => [
                    0 => [
                        'id' => 1,
                        'snd' => 'sender',
                        'rcv' => 'receiver1',
                        'text' => 'text',
                    ],
                    1 => [
                        'id' => 2,
                        'snd' => 'sender',
                        'rcv' => 'receiver2',
                        'text' => 'text',
                    ],
                ],
            ],
        ];

        $expected = "<?xml version=\"1.0\"?><SESSION><CLIENT>username</CLIENT><PW>password</PW><MSGLST><MSG><ID>1</ID><SND>sender</SND><RCV>receiver1</RCV><TEXT>text</TEXT></MSG><MSG><ID>2</ID><SND>sender</SND><RCV>receiver2</RCV><TEXT>text</TEXT></MSG></MSGLST></SESSION>";
        $expected = $this->formatXML($expected);

        $this->assertEquals($expected, XMLParser::parse($messages));
    }

    protected function formatXML($unformatted)
    {
        $xml = new DOMDocument();
        $xml->formatOutput = true;
        $xml->loadXML($unformatted);

        return $xml->saveXML();
    }
}
