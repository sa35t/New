<?php

require_once dirname(__FILE__) .'/libs/Rest.php';
require_once dirname(__FILE__) .'/libs/Bootstrap.php';
require_once dirname(__FILE__) .'/libs/Controller.php';
require_once dirname(__FILE__) .'/config/config.php';
require_once dirname(__FILE__) .'/libs/Auth.php';
require_once dirname(__FILE__) .'/libs/Database.php';
require_once dirname(__FILE__) .'/utils/helperFunction.php';
require_once dirname(__FILE__) .'/libs/ErrorAndMessages.php';


/* Get the header Request */
$headers = getallheaders();
/* Authenticating access token and TTL */
Auth::init($headers);
$key = $headers['X-DummyShopping-Api-Key'];
/* Check Api key if it is same as we have defined in config.php */
if($key===API_KEY)
{
  /* Instantiate the object of a class */
  $bootstrap = new Bootstrap();
}
else
{
    ErrorAndMessages::generalError("Access Denied! Enter valid key",401);
}
?>