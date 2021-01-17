<?php

namespace Nerdbrygg\SimpleSMS\Tests\Unit;

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
                        'text' => 'text'
                    ]
                ]
            ]
        ];

        $expected = "<?xml version=\"1.0\"?>\n<session><client>username</client><pw>password</pw><msglst><msg><id>1</id><snd>sender</snd><rcv>receiver</rcv><text>text</text></msg></msglst></session>\n";

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
                        'text' => 'text'
                    ],
                    1 => [
                        'id' => 2,
                        'snd' => 'sender',
                        'rcv' => 'receiver2',
                        'text' => 'text'
                    ]
                ]
            ]
        ];

        $expected = "<?xml version=\"1.0\"?>\n<session><client>username</client><pw>password</pw><msglst><msg><id>1</id><snd>sender</snd><rcv>receiver1</rcv><text>text</text></msg><msg><id>2</id><snd>sender</snd><rcv>receiver2</rcv><text>text</text></msg></msglst></session>\n";

        $this->assertEquals($expected, XMLParser::parse($messages));
    }
}
