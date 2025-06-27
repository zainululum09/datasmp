<?php

class Template extends Controller
{
    var $template_data = array();

    public function set($name, $value)
    {
        $this->template_data[$name] = $value;
    }

    public function load($template = '', $view = '', $view_data = array(), $return = FALSE)
    {
        $this->set('contents', $this->view($view, $view_data, TRUE));
        return $this->view($template, $this->template_data, $return);
    }
}
