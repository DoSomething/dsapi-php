<?php

class RequestTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Exception
     */
    public function testMissingAccessTokenThrowsException()
    {
        $RequestClient = new Request();
    }

    public function testAccessTokenSet()
    {
        $token = 123;
        $RequestClient = new Request(123);
        
        return $this->assertTrue(
            $RequestClient->getAcessToken() == $token
        );
    }

    public function testUrlBuildWithParams()
    {
        $token = 123;
        $RequestClient = new Request(123);
        
        $params = array(
            'a' => 1,
            'b' => 2
        );

        $url = $RequestClient->buildURL('method', $params);
        $expected = $RequestClient->base_endpoint . '/method?a=1&b=2';
        return $this->assertTrue($url == $expected);
    }

    public function testUrlBuildWithoutParams()
    {
        $token = 123;
        $RequestClient = new Request(123);
        
        $url = $RequestClient->buildURL('method');
        $expected = $RequestClient->base_endpoint . '/method';
        return $this->assertTrue($url == $expected);
    }

    /**
     * @expectedException Exception
     */
    public function testUrlBuildMissingMethodThrowsException()
    {
        $RequestClient = new Request(123);
        $RequestClient->buildURL();
    }
}
