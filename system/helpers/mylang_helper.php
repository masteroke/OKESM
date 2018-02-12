<?php


if ( ! function_exists('lang'))
{
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    /**
     * Lang
     * @return  string
     */
    function lang_echo($line)
    {
        echo $this->lang->line($line);
    }
}
