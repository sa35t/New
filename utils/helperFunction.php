<?php

    /*
    * Contain all the helper function used
    */


    /*
    * Function to Remove Unwanted Fields
    * $data contains main array and
    * $fieldsToBeRemoved contains fields which need to be remove
    * For Multi Dimensional Array
    */

    function removingUnwantedFields($data , $fieldsToBeRemoved )
    {
        $temp = $fieldsToBeRemoved;
        foreach ($data as $key => &$value)
        {
            $fieldsToBeRemoved = $temp;
            foreach ($fieldsToBeRemoved as $key => $fieldsToBeRemoved)
            {
                unset($value[$fieldsToBeRemoved]);
            }
        }
        return $data;
    }

    /*
    * Function to Remove Unwanted Fields
    * $data contains main array and
    * $fieldsToBeRemoved contains fields which need to be remove
    * For Single Dimension array
    */

     function removeUnwantedFieldsSingle($data , $fieldsToBeRemoved )
     {
        foreach ($data as $key => $value)
        {
            foreach ($fieldsToBeRemoved as $fields => $values)
            {
                if($key===$values)
                {
                    unset($data[$key]);
                }
            }
        }
        return $data;
     }

     /*
     * Getting value from Config entry
     * Get array and return string
     * array(0=>[a] 1=>[b])
     * string 'a','b'
     */

     function convertArrayIntoString($status)
     {
        /* Get last elememt of an status array */
        $lastElement = end($status);
        $statusValue;
        foreach ($status as $key => $value)
        {
            /* If element is last value in array */
            if($value === $lastElement)
                $statusValue .= "'$value'";
            else
                $statusValue .= "'$value',";
        }
        return $statusValue;
     }

     /*
     * Helper Function to change url from "login.php?email=xpsdell49@yahoo.com&password=123456"
     * to
     * Array ([url] => login.php
     * [email] => xpsdell49@yahoo.com
     * [password] => 123456 )
     */

     function queryStringToArray($string)
     {
        $url = explode('&',$string);
        /* Request variable to store all parameters */
        $request= array();
        foreach ($url as $key => $value)
        {
            $new = explode('=',$value);
            $request[$new[0]]=$new[1];
        }
        return $request;
     }

     /*
     * Function to check if all the value of a key is set or not
     * and check sql injection
     */

     function checkArray($data)
     {
        foreach ($data as $key => $value)
        {
            if(is_array($value))
            {
                checkArray($value);
            }
            else
            {
                /* Handling sql injection */
                $value = mysql_real_escape_string($value);
            }
            if($value == "")
            {
                $data= array('status'=>'fail', 'key'=>$key);
                return $data;
            }
        }
        $data= array('status'=>'success');
        return $data;
     }


 ?>