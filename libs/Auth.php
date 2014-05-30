<?php

/**
* Class to authenticate acess token
*/
class Auth
{
    /* List all our secure APIs for which we want to chech access token */
    private static $secureApi = array('products');
    private static  $userId;
    private static  $timestamp;
    private static  $api;
    /* User calculated token */
    private static $token;

    public static function init($parameters)
    {
        $requestParams = REST::getRequestParams();
        Auth::$userId = $requestParams['user_id'];
        Auth::$api = $requestParams['url'];
        Auth::$token = $parameters['X-token'];
        Auth::$timestamp = $parameters['X-time'];
        Auth::authenticate();
    }

    private static function authenticate()
    {
        if(in_array(Auth::$api,Auth::$secureApi))
        {
            $tokemParams = Auth::$userId.'|'."this is Dummy shopping random message";
            $token = hash_hmac('sha256', $tokemParams, SALT);
            if(!(Auth::$token==$token))
            {
                ErrorAndMessages::generalError("INVALID_TOKEN",401);
            }
            elseif(!(time()-Auth::$timestamp <TTL))
            {
                ErrorAndMessages::generalError("TOKEN_EXPIRED",401);
            }
        }
    }
}