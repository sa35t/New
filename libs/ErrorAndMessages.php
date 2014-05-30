<?php

/*
* Class to handle all error and
* message related stuffs
*/

class ErrorAndMessages
{
    /* Handle all http request errors */

    public static function httpError($moduleName='')
    {
        if(!empty($data))
        {
            $msg = array('status'=>'Fail',"msg"=>"Invalid Http Request");
            $msg = array("error"=>$msg);
            REST::response($msg,400);
        }
        else
        {
            $msg = array('status'=>'Fail',"msg"=>"Please enter valid Http request for $moduleName");
            $msg = array("error"=>$msg);
            REST::response($msg,400);
        }
    }

    /* For Invalid json format */
    public static function jsonError()
    {
        $msg = array('status' => "Fail", "msg" => "Invalid Json format");
        $msg = array("error"=>$msg);
        REST::response($msg,400);
    }

    /* If header type is entered in correctly */

    public static function headerTypeError()
    {
        $msg = array('status' => "Fail", "msg" => "Please set correct header type");
        $msg = array("error"=>$msg);
        REST::response($msg,400);
    }

    /* Function to handle if data is set */
    public static function contentHandling($data,$moduleName,$msg='')
    {
         $msg = array('msg' =>$msg,$moduleName=>$data);
         $msg = array("success"=>$msg);
         REST::response($msg,200);
    }

    /* Function to handle parameter related errors */
    public static function  parameterError($moduleName='')
    {
        if(!empty($moduleName))
        {
            $msg = array('status'=>'Fail',"msg"=>"Please enter correct $moduleName parameters");
            $msg = array("error"=>$msg);
            REST::response($msg,400);
        }
        else
        {
            $msg = array('status'=>'Fail',"msg"=>"Please enter all parameters correctly");
            $msg = array("error"=>$msg);
            REST::response($msg,400);
        }
    }

    /* Function for all General Errors */

    public static function generalError($msg,$statusCode)
    {
        $msg = array("status"=>"Fail","msg"=>$msg);
        $msg = array("error"=>$msg);
        REST::response($msg,$statusCode);
    }
}