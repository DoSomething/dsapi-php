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
     * Curl client
     */
    private $_curl;

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

        $this->_curl = curl_init();
        curl_setopt($this->_curl, CURLOPT_USERAGENT, 'DSAPI-PHP/1.0.0');
        curl_setopt($this->_curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($this->_curl, CURLOPT_HEADER, 1);
        curl_setopt($this->_curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->_curl, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($this->_curl, CURLOPT_TIMEOUT, 600);
    }

    /**
     * Destructor
     *
     * @return void
     */
    function __destruct() {
        curl_close($this->_curl);
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
     * @param string  $method
     * @param array  $params
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

    /**
     * Method that makes request to the API
     * @param string  $method
     * @param array  $params
     *
     * @return array
     */
    private function _call() {
        $result = curl_exec($this->_curl);

        $info = curl_getinfo($this->_curl);

        if(curl_error($this->_curl)) {
            throw new Exception(curl_error($this->_curl));
        }

        return array();
    }

    /**
     * Convience method for get requests
     * @param string  $method
     * @param array  $params
     *
     * @return array
     */
    public function get($method, $params = array()) {
        $url = $this->buildURL($method, $params = array());
        curl_setopt($this->_curl, CURLOPT_URL, $url);
        return $this->_call();
    }

    /**
     * Convience method for post requests
     * @param string  $method
     * @param array  $params
     *
     * @return array
     */
    public function post($method, $params = array()) {
        $url = $this->buildURL($method, $params = array());
        curl_setopt($this->_curl, CURLOPT_URL, $url);
        curl_setopt($this->_curl, CURLOPT_POST, true);
        curl_setopt($this->_curl, CURLOPT_POSTFIELDS, $params);
        return $this->_call();
    }
}
