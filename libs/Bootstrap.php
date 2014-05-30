<?php

/*
* Bootstrap file which check if
* entered file name is exist and
* load controller according to that filename
*/

class Bootstrap
{
    public function __construct()
    {
        REST::init();
        self::checkfile();
    }

    private function checkFile()
    {
        /* Get all request variables */
        $requestParams = REST::getRequestParams();
        /* Getting the value of url variable */
        $filename = $requestParams['url'];
        $file = dirname(__FILE__) .'/../Controllers'.'/'.$filename.'.php';
        if(file_exists($file))
        {
            require_once($file);
            if(class_exists($filename))
            {
                $filename = new $filename();
            }
            else
            {
                ErrorAndMessages::generalError("Class doesnot Exist",400);
            }
        }else
        {
            ErrorAndMessages::generalError("Please enter correct Url",400);
        }
    }
}
?>