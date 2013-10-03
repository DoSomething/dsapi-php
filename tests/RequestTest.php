<?php

class RequestTest extends PHPUnit_Framework_TestCase
{
    public $mock_endpoints = array(
        200 => 'http://www.mocky.io/v2/524da317471a7e720392417e',
        404 => 'http://www.mocky.io/v2/524da30b471a7e720392417c',
        500 => 'http://www.mocky.io/v2/524da284471a7e6f0392417b'
    );

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
        
        $params = array('a' => 1,'b' => 2);

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

    /**
     * @expectedException Exception
     */
    public function testGetRequestMissingMethodThrowsException()
    {
        $RequestClient = new Request(123);
        $RequestClient->get();
    }

    public function testGetRequest()
    {
        $RequestClient = new Request(123);
        $RequestClient->base_endpoint = $this->mock_endpoints[200];
        $response = $RequestClient->get('method');
        return $this->assertFalse(is_null($response));
    }

    /**
     * @expectedException Exception
     */
    public function testPostRequestMissingMethodThrowsException()
    {
        $RequestClient = new Request(123);
        $RequestClient->post();
    }

    public function testPostRequest()
    {
        $RequestClient = new Request(123);
        $RequestClient->base_endpoint = $this->mock_endpoints[200];
        $response = $RequestClient->post('method');
        return $this->assertFalse(is_null($response));
    }

    /**
     * @expectedException Exception
     */
    public function testRequestCurlErrorThrowsException()
    {
        $RequestClient = new Request(123);
        $RequestClient->__destruct();
        $RequestClient->get('method');
    }

    /**
     * @expectedException Exception
     */
    public function testRequestCurlUnknownErrorThrowsException()
    {
        $RequestClient = new Request(123);
        $RequestClient->base_endpoint = $this->mock_endpoints[500];
        $RequestClient->get('method');
    }

    /**
     * @expectedException Exception
     */
    public function testRequestCurlNotFoundErrorThrowsException()
    {
        $RequestClient = new Request(123);
        $RequestClient->base_endpoint = $this->mock_endpoints[400];
        $RequestClient->get('method');
    }

}
