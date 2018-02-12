<?php

class MY_Loader extends CI_Loader {
    
    public function template($template_name, $vars = array(), $return = FALSE)
    {     
        $view_filename = substr(strrchr($template_name, "/"), 1);
        
        $content = '';   

        $view_order = $_SERVER['DOCUMENT_ROOT'] . '/' . APPPATH . 'views' . '/'; 

        if (@file_exists($view_order."templates/header/header_".$view_filename.EXT)){
            $content  .= $this->view('templates/header/header_' . $view_filename, $vars, $return);
        }

        $content .= $this->view($template_name, $vars, $return);
        
        if (@file_exists($view_order."templates/footer/_footer_{$view_filename}".EXT)){
            $content  .= $this->view('templates/footer/footer_' . $view_filename, $vars, $return);
            
        }
        
        if ($return)
        {
            return $content;
        }
    }   
    
    public function templateA($template_name, $vars = array(), $return = FALSE)
    {     

        $content = '';   

        $content  .= $this->view('templates/header/header', $vars, $return);

        $content  .= $this->view($template_name, $vars, $return);

        $content  .= $this->view('templates/footer/footer', $vars, $return);
        
        
        if ($return)
        {
            return $content;
        }
    } 
    
    public function templateB($template_name, $vars = array(), $return = FALSE)
    {     

        $view_filename = substr(strrchr($template_name, "/"), 1);
        
        $content = '';   

        $view_order = $_SERVER['DOCUMENT_ROOT'] . '/' . APPPATH . 'views' . '/'; 

        if (@file_exists($view_order."templates/header/header_".$view_filename.EXT)){
            $content  .= $this->view('templates/header/header_' . $view_filename, $vars, $return);
        }
        
        $content  .= $this->view($template_name, $vars, $return);

        $content  .= $this->view('templates/footer/footer', $vars, $return);
        
        
        if ($return)
        {
            return $content;
        }
    } 
}