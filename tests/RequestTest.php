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
}
