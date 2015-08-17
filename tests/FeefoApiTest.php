<?php

use Prophecy\Argument;

class FeefoApiTest extends PHPUnit_Framework_TestCase
{
    private $obj;

    protected function setUp()
    {
        $responseProphecy = $this->prophesize('\GuzzleHttp\Psr7\Response');
        $responseProphecy->getBody()->willReturn(file_get_contents(__DIR__.'/test.xml'));

        $guzzleProphecy = $this->prophesize('\GuzzleHttp\Client');
        $guzzleProphecy->get(Argument::any())->willReturn($responseProphecy->reveal());

        $guzzleMock = $guzzleProphecy->reveal();

        $this->obj = new \Amara\FeefoApi($guzzleMock);
    }

    public function testGetReviews()
    {
        $expected = '{"count":"18","average":"94"}';
        $actual = $this->obj->getReviews(111);

        $this->assertEquals($expected, $actual);
    }
}
