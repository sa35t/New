<?php

/*
* Parent controller class, it is extended by
* all other controllers, it check for
* whether model corresponding to controller class
* is exist or not, if exist then load that model
*/

class Controller
{
    protected function loadModel($name)
    {
        $modelPath = dirname(__FILE__) .'/../Models/'.$name.'Model.php';
        if(file_exists($modelPath))
        {
            require_once($modelPath);
            /* Checking If file exist or not */
            if(class_exists($name.'Model'))
            {
                /* Assigning name of the Model */
                $modelName = $name.'Model';
                return new $modelName;
            }
            else
            {
                /* Throwing error if Class not found*/
                ErrorAndMessages::generalError("ModelClass doesnot Exist",400);
            }
        }else
        {
            /* Throwing error if File not found*/
            ErrorAndMessages::generalError("ModelFile doesnot Exist",400);
        }
    }
}
?>