<?php

/**
 * The function `setMessage` in PHP sets a message of a specified type in the session.
 * 
 * @param string type The `type` parameter in the `setMessage` function is a string that specifies the
 * type of message being set. It is used as the key to store the message in the `` superglobal
 * array.
 * @param string msg The `msg` parameter in the `setMessage` function is a string that represents the
 * message you want to set for a specific type.
 * 
 * @return void In the provided code snippet, the function `setMessage` is defined with a return type
 * declaration of `void`. This means that the function does not return any value. Therefore, even
 * though there is a `return;` statement in the function, it does not return any specific value.
 */
function setMessage(string $type,string $msg):void{
    $_SESSION[$type]=$msg;
    return;
}


/**
 * The function `redirection` in PHP is used to redirect the user to a specified URL.
 * 
 * @param string dirrection The `redirection` function takes a string parameter named ``
 * with a default value of `"./index.php"`. This parameter specifies the URL to which the user will be
 * redirected when the function is called. If no value is provided when calling the function, the
 * default redirection URL is set
 */
function redirection(string $dirrection="./index.php"):void{
 
    header("Location:$dirrection");
}


?>