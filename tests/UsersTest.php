<?php

class UsersTest extends PHPUnit_Framework_TestCase
{
    public $mock_endpoints = array(
        200 => 'http://www.mocky.io/v2/524da317471a7e720392417e',
        404 => 'http://www.mocky.io/v2/524da30b471a7e720392417c',
        500 => 'http://www.mocky.io/v2/524da284471a7e6f0392417b'
    );

    public function testUserCreate()
    {
        $RequestClient = new Request(123);
        $RequestClient->base_endpoint = $this->mock_endpoints[200];
        $resource = new UsersResource($RequestClient);
        $response = $resource->create(array());
        return $this->assertFalse(is_null($response));
    }
}
