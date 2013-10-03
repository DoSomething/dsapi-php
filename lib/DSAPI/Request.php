<?php

/*
 * Request
 * This classes handles the HTTP requests.
 */

class Request
{
	/**
     * Base API endpoint
     */
    public $base_endpoint = 'http://api.dosomething.org/v1.0';

    /**
     * OAuth Access Token
     */
    private $_access_token;

    /**
     * Constructor
     *
     * @param array $access_token
     * @return void
     */
    function __construct($access_token = NULL) {
        if (!($access_token)) {
            throw new Exception(
                "Configuration:  Missing access_token."
            );
        }
        $this->_setAccessToken($access_token);
    }

    /**
     * Access Token Setter
     *
     * @param string  $username
     * @param string  $password
     * @return void
     */
    private function _setAccessToken($access_token)
    {
        $this->_access_token = $access_token;
    }

    /**
     * Access Token Getter
     *
     * @return string
     */
    public function getAcessToken()
    {
        return $this->_access_token;
    }

    /**
     * Helper method to build API request URL
     *
     * @return string
     */
    public function buildURL($method, $params = array())
    {
        $url = $this->base_endpoint . '/' . $method;

        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }
        
        return $url;
    }
}
