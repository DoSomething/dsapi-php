<?php

if (!function_exists('curl_init')) {
    throw new Exception('DSAPI needs the CURL PHP extension.');
}

require(dirname(__FILE__) . '/DSAPI/Request.php');
require(dirname(__FILE__) . '/DSAPI/UsersResource.php');
