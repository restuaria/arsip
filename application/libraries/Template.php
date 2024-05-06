<?php

class Template
{

    var $template_data_depan = array();

    function set($name, $value)
    {
        $this->template_data_depan[$name] = $value;
    }

    function load($template = '', $view = '', $view_data = array(), $return = FALSE)
    {
        $this->CI = &get_instance();
        $this->set('conten', $this->CI->load->view($view, $view_data, TRUE));
        return $this->CI->load->view($template, $this->template_data_depan, $return);
    }
}
