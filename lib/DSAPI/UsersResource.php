<?php

/*
 * Users
 * This class provides convienece methods for making calls against
 * the Users resource.
 */

class UsersResource {

    /**
     * Request client object
     */
    private $_client;

    /**
     * Constructor
     *
     * @param array $access_token
     * @return void
     */
    public function __construct($RequestClient) {
        $this->_client = $RequestClient;
    }

    public function create($params) {
        $response = $this->_client->post(
            'users',
            $params
        );

        return $response;
    }
}