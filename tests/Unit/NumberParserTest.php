<?php

namespace Nerdbrygg\SimpleSMS\Tests\Unit;

use Nerdbrygg\SimpleSMS\Support\NumberParser;
use Nerdbrygg\SimpleSMS\Tests\TestCase;

class NumberParserTest extends TestCase
{
    /** @test */
    public function it_returns_a_collection()
    {
        $parsedNumber = NumberParser::parse('4711111111');

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $parsedNumber);
    }

    /** @test */
    public function it_parses_a_comma_separated_string()
    {
        $parsedNumbers = NumberParser::parse('4711111111, 4722222222');

        $this->assertCount(2, $parsedNumbers);
        $this->assertEquals(collect(['4711111111', '4722222222']), $parsedNumbers);
    }

    /** @test */
    public function it_parses_a_semicolon_separated_string()
    {
        $parsedNumbers = NumberParser::parse('4711111111; 4722222222');

        $this->assertCount(2, $parsedNumbers);
    }

    /** @test */
    public function it_parses_a_pipe_separated_string()
    {
        $numbers = '4712345678 | 4787654321';
        $parsedNumbers = NumberParser::parse($numbers);

        $this->assertCount(2, $parsedNumbers);
        $this->assertEquals(collect(['4712345678', '4787654321']), $parsedNumbers);
    }

    /** @test */
    public function it_parses_a_dot_separated_string()
    {
        $parsedNumbers = NumberParser::parse('87654321.12345678');

        $this->assertCount(2, $parsedNumbers);
    }

    /** @test */
    public function it_prepends_the_given_countryCode()
    {
        $parsedNumber = NumberParser::parse('11111111');

        $this->assertEquals(collect('4711111111'), $parsedNumber);
    }

    /** @test */
    public function it_doesnt_prepend_a_countryCode_when_it_is_provided()
    {
        $parsedNumber = NumberParser::parse('4712345678');

        $this->assertEquals(collect('4712345678'), $parsedNumber);
    }
}
